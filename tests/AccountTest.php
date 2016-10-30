<?php

use PHPUnit\Framework\TestCase;
use SpryngPaymentsApiPhp\Client;

class AccountTest extends TestCase
{
    const TEST_API_KEY  = '';

    protected $client;

    public function setUp()
    {
        $this->client = new Client(static::TEST_API_KEY, true);
    }

    function testExceptionIsRaisedOnConstruction()
    {
        $this->assertInstanceOf('SpryngPaymentsApiPhp\Client', $this->client);
    }

    public function testGetAllAccounts()
    {
        $accounts = $this->client->account->getAll();
        foreach($accounts as $account)
        {
            $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Account', $account);
        }
    }
}