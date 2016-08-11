<?php

use PHPUnit\Framework\TestCase;
use SpryngPaymentsApiPhp\Client;

class TransactionTest extends TestCase
{
    const TEST_API_KEY = '';

    public function testExceptionIsRaisedOnContruction()
    {
        $client = new SpryngPaymentsApiPhp\Client(self::TEST_API_KEY);

        $this->assertInstanceOf('SpryngPaymentsApiPhp\Client', $client);
    }

    public function testGetAllTransactionsDoesNotReturnNull()
    {
        $client = new SpryngPaymentsApiPhp\Client(self::TEST_API_KEY);

        $response = $client->transaction->getAll();

        $this->assertTrue($response !== null);
    }

    public function testGetAllTransactionsAreTransactionInstances()
    {
        $client = new \SpryngPaymentsApiPhp\Client(self::TEST_API_KEY);

        $response = $client->transaction->getAll();

        foreach($response as $transaction)
        {
            $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Transaction', $transaction);
        }
    }
}