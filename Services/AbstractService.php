<?php

namespace A5sys\PydioBundle\Services;

use GuzzleHttp\Client;

/**
 * Class AbstractService
 * @package A5sys\PydioBundle\Services
 */
abstract class AbstractService
{
    /**
     * @var string
     */
    protected $user;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $baseApiUrl;
    /**
     * @var string
     */
    protected $apiUrl;

    /**
     *  is used to list, create files and folders, rename them, etc.. via the various HTTP methods.
     */
    public const API_V2_FS_COMMAND = 'fs';

    /**
     * is used to manage actual files data, i.e. upload or download data via GET / PUT methods.
     */
    public const API_V2_IO_COMMAND = 'io';

    /**
     * @param string $user       User
     * @param string $password   Password
     * @param string $baseApiUrl Base url (i.e http://mydomain.com)
     * @param string $apiUrl     API suffix (i.e /pydio/api/v2)
     */
    public function __construct(string $user, string $password, string $baseApiUrl, string $apiUrl)
    {
        $this->user = $user;
        $this->password = $password;
        $this->baseApiUrl = $baseApiUrl;
        $this->apiUrl = $apiUrl;
    }

    /**
     * @param string $uri
     * @param string $method
     * @param string $body
     * @param bool   $transformXml
     * @return mixed
     */
    protected function exec(string $uri, $method = 'GET', $body = null, $transformXml = true)
    {
        $client = new Client([
            'base_uri' => $this->baseApiUrl,
            'timeout'  => 50.0,
        ]);

        $params = [
            \GuzzleHttp\RequestOptions::AUTH => [$this->user, $this->password],
        ];

        if ($body !== null) {
            $params[\GuzzleHttp\RequestOptions::BODY] = $body;
        }

        $response = $client->request($method, $uri, $params);
        $content = $response->getBody()->getContents();

        if ($transformXml) {
            $xml = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $result = json_decode($json, true);
        } else {
            $result = $content;
        }

        return $result;
    }
}
