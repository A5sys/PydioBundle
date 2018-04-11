<?php

namespace A5sys\PydioBundle\Services;

use A5sys\PydioBundle\Exception\DirectoryNotCreatedException;
use A5sys\PydioBundle\Exception\DirectoryNotRemovedException;

/**
 * Class DirectoryService
 * @package A5sys\PydioBundle\Services
 */
class DirectoryService extends AbstractService
{
    /**
     * @param string $namespace
     * @return mixed
     */
    public function ls(string $namespace)
    {
        $uri = $this->apiUrl.'/'.static::API_V2_FS_COMMAND.'/'.$namespace.'/?children=df';

        return $this->exec($uri);
    }

    /**
     * @param string $namespace
     * @return mixed
     */
    public function getMetadata(string $namespace)
    {
        $uri = $this->apiUrl.'/'.static::API_V2_FS_COMMAND.'/'.$namespace;

        return $this->exec($uri);
    }

    /**
     * @param string $namespace
     * @param string $name
     * @return mixed
     * @throws DirectoryNotCreatedException
     */
    public function createDirectory(string $namespace, string $name)
    {
        $uri = $this->apiUrl.'/'.static::API_V2_FS_COMMAND.'/'.$namespace.'/'.$name.'/';

        $array = $this->exec($uri, 'POST');

        if (!array_key_exists('nodes_diff', $array)) {
            throw new DirectoryNotCreatedException('The directory '.$name.' could not be created');
        }

        return $array;
    }

    /**
     * @param string $namespace
     * @param string $name
     * @return mixed
     * @throws DirectoryNotRemovedException
     */
    public function removeDirectory(string $namespace, string $name)
    {
        $uri = $this->apiUrl.'/'.static::API_V2_FS_COMMAND.'/'.$namespace.'/'.$name.'/';

        $array = $this->exec($uri, 'DELETE');

        if (!array_key_exists('nodes_diff', $array)) {
            throw new DirectoryNotRemovedException('The directory '.$name.' could not be removed');
        }

        return $array;
    }
}
