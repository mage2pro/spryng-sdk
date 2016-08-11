<?php

use PHPUnit\Framework\TestCase;
use SpryngPaymentsApiPhp\Client;

class TransactionTest extends TestCase
{
    const TEST_API_KEY = '';

    const TEST_TRANSACTION_ID = '';

    protected $client;

    public function setUp()
    {
        $this->client = new Client(static::TEST_API_KEY);
    }

    public function testExceptionIsRaisedOnContruction()
    {
        $this->assertInstanceOf('SpryngPaymentsApiPhp\Client', $this->client);
    }

    public function testGetAllTransactionsDoesNotReturnNull()
    {
        $response = $this->client->transaction->getAll();

        $this->assertTrue($response !== null);
    }

    public function testGetAllTransactionsAreTransactionInstances()
    {
        $response = $this->client->transaction->getAll();

        foreach($response as $transaction)
        {
            $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Transaction', $transaction);
        }
    }

    public function testGetTransactionByIdDoesNotReturnNull()
    {
        $transaction = $this->client->transaction->getTransactionById(static::TEST_TRANSACTION_ID);

        $this->assertTrue($transaction !== null);
    }

    public function testGetTransactionByIdReturnsTransactionInstance()
    {
        $transaction = $this->client->transaction->getTransactionById(static::TEST_TRANSACTION_ID);

        $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Transaction', $transaction);
    }
}