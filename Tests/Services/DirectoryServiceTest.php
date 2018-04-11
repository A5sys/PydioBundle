<?php

namespace A5sys\PydioBundle\Tests\Services;

use A5sys\PydioBundle\Services\DirectoryService;
use A5sys\PydioBundle\Tests\TestCase;

/**
 *
 *
 */
class DirectoryServiceTest extends TestCase
{
    /** @var DirectoryService */
    private $directoryService;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->directoryService = new DirectoryService($this->login, $this->password, $this->baseApiUrl, $this->apiUrl);
    }

    /**
     *
     */
    public function testLs()
    {
        $content = $this->directoryService->ls($this->namespace);

        $listing = $content['tree'];
        $this->assertCount(1, $listing);
        $this->assertEquals('/recycle_bin', $listing['@attributes']['filename']);
    }

    /**
     *
     */
    public function testMetadata()
    {
        $content = $this->directoryService->getMetadata($this->namespace);
        $this->assertCount(2, $content);
        $this->assertArrayHasKey('tree', $content);
        $this->assertArrayHasKey('@attributes', $content);
    }

    /**
     * Warning: if this test crashes, you might have to manually remove the created folder
     *
     */
    public function testDirectory()
    {
        $directorName = 'pydio-test';
        $this->directoryService->createDirectory($this->namespace, $directorName);
        $content = $this->directoryService->ls($this->namespace);
        $listing = $content['tree'];
        // there must be only the bin and the folder
        $this->assertCount(2, $listing);
        // the created folder is the first element of the list
        $this->assertEquals('/'.$directorName, $listing[0]['@attributes']['filename']);
        $this->directoryService->removeDirectory($this->namespace, $directorName);

        $content = $this->directoryService->ls($this->namespace);
        $listing = $content['tree'];
        // there must be only the bin
        $this->assertCount(1, $listing);
    }
}
