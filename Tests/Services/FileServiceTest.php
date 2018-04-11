<?php

namespace A5sys\PydioBundle\Tests\Services;

use A5sys\PydioBundle\Services\DirectoryService;
use A5sys\PydioBundle\Services\FileService;
use A5sys\PydioBundle\Tests\TestCase;

/**
 *
 *
 */
class FileServiceTest extends TestCase
{
    /** @var FileService */
    private $fileService;

    /** @var DirectoryService */
    private $directoryService;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->fileService = new FileService($this->login, $this->password, $this->baseApiUrl, $this->apiUrl);
        $this->directoryService = new DirectoryService($this->login, $this->password, $this->baseApiUrl, $this->apiUrl);
    }

    /**
     *
     */
    public function testFile()
    {
        $filename = 'test-file.txt';
        $fileContent = 'this is some file content';
        $this->fileService->createFile($this->namespace, $filename, $fileContent);

        $content = $this->directoryService->ls($this->namespace);
        $listing = $content['tree'];
        // there must be only the bin and the file
        $this->assertCount(2, $listing);

        $fileContentData = $this->fileService->getFileContent($this->namespace, $filename);
        $this->assertEquals($fileContent, $fileContentData);

        $this->fileService->removeFile($this->namespace, $filename);
        $content = $this->directoryService->ls($this->namespace);
        $listing = $content['tree'];
        // there must be only the bin
        $this->assertCount(1, $listing);
    }
}
