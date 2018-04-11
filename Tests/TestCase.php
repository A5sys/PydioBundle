<?php

namespace A5sys\PydioBundle\Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 *
 *
 */
class TestCase extends PHPUnitTestCase
{
    protected $baseApiUrl;
    protected $apiUrl;
    protected $login;
    protected $password;
    protected $namespace;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->baseApiUrl = $GLOBALS['baseApiUrl'];
        $this->apiUrl = $GLOBALS['apiUrl'];
        $this->login = $GLOBALS['login'];
        $this->password = $GLOBALS['password'];
        $this->namespace = $GLOBALS['namespace'];

        if ($this->baseApiUrl === 'https://yourPydioUrl') {
            throw new \LogicException('Please set your baseApiUrl in phpunit.xml');
        }
        if ($this->login === 'yourTestLogin') {
            throw new \LogicException('Please set your login in phpunit.xml');
        }
        if ($this->password === 'yourTestPassword') {
            throw new \LogicException('Please set your password in phpunit.xml');
        }
        if ($this->namespace === 'your-namespace') {
            throw new \LogicException('Please set your namespace in phpunit.xml (example: my-files');
        }
    }
}
