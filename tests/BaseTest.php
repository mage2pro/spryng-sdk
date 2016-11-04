<?php

use PHPUnit\Framework\TestCase;
use SpryngPaymentsApiPhp\Client;

date_default_timezone_set('Europe/Amsterdam');

class BaseTest extends TestCase
{
    const TEST_API_KEY = "";

    protected $client;

    public function setUp()
    {
        $this->client = new Client(static::TEST_API_KEY, true);
    }

    public function testExceptionIsRaisedOnContruction()
    {
        $this->assertInstanceOf('SpryngPaymentsApiPhp\Client', $this->client);
    }
}