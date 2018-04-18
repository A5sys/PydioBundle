<?php

namespace A5sys\PydioBundle\Services;

use A5sys\PydioBundle\Exception\FileNotCreatedException;
use A5sys\PydioBundle\Exception\FileNotFoundException;
use A5sys\PydioBundle\Exception\FileNotRemovedException;

/**
 * Class FileService
 * @package A5sys\PydioBundle\Services
 */
class FileService extends AbstractService
{
    /**
     * @param string $namespace
     * @param string $filename
     * @param string $content
     * @return mixed
     * @throws FileNotCreatedException
     */
    public function createFile(string $namespace, string $filename, string $content)
    {
        $uri = $this->apiUrl.'/'.static::API_V2_IO_COMMAND.'/'.$namespace.'/'.$filename;

        $array = $this->exec($uri, 'PUT', $content);

        if (!array_key_exists('nodes_diff', $array)) {
            throw new FileNotCreatedException('The file '.$filename.' could not be created');
        }

        return $array;
    }

    /**
     * @param string $namespace
     * @param string $filename
     * @return mixed
     * @throws FileNotFoundException
     */
    public function getFileContent(string $namespace, string $filename)
    {
        $uri = $this->apiUrl.'/'.static::API_V2_IO_COMMAND.'/'.$namespace.'/'.$filename;

        $content = $this->exec($uri, 'GET', null, false);
        // check error
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOCDATA);
        if ($xml) {
            $json = json_encode($xml);
            $result = json_decode($json, true);
            if (isset($result['message'])) {
                throw new FileNotFoundException($result['message']);
            }
        }
        libxml_clear_errors();

        return $content;
    }

    /**
     * @param string $namespace
     * @param string $name
     * @return mixed
     * @throws FileNotRemovedException
     */
    public function removeFile(string $namespace, string $name)
    {
        $uri = $this->apiUrl.'/'.static::API_V2_FS_COMMAND.'/'.$namespace.'/'.$name;

        $array = $this->exec($uri, 'DELETE');

        if (!array_key_exists('nodes_diff', $array)) {
            throw new FileNotRemovedException('The directory '.$name.' could not be removed');
        }

        return $array;
    }
}
