<?php

namespace A5sys\PydioBundle\Services;

use A5sys\PydioBundle\Exception\FileNotCreatedException;
use A5sys\PydioBundle\Exception\FileNotRemovedException;

/**
 * Class SearchService
 * @package A5sys\PydioBundle\Services
 */
class SearchService extends AbstractService
{
    /**
     * @param string $namespace
     * @param string $query
     * @return mixed
     * @throws FileNotCreatedException
     */
    public function search(string $namespace, string $query)
    {
        // /workspace_alias/search/query
        $uri = '/pydio/api/'.$namespace.'/search/'.$namespace.'/'.$query;

        return $this->exec($uri, 'GET');
    }
}
