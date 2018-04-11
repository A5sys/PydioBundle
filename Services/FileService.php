<?php

namespace A5sys\PydioBundle\Services;

use A5sys\PydioBundle\Exception\FileNotCreatedException;
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
     */
    public function getFileContent(string $namespace, string $filename)
    {
        $uri = $this->apiUrl.'/'.static::API_V2_IO_COMMAND.'/'.$namespace.'/'.$filename;

        return $this->exec($uri, 'GET', null, false);
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
