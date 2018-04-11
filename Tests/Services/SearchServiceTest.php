<?php

namespace A5sys\PydioBundle\Tests\Services;

use A5sys\PydioBundle\Services\SearchService;
use A5sys\PydioBundle\Tests\TestCase;

/**
 *
 *
 */
class SearchServiceTest extends TestCase
{
    /** @var SearchService */
    private $searchService;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->searchService = new SearchService($this->login, $this->password, $this->baseApiUrl, $this->apiUrl);
    }

    /**
     *
     */
    public function testFile()
    {
        $this->searchService->search($this->namespace, 'test');
    }
}
