<?php

use PHPUnit\Framework\TestCase;
use SpryngPaymentsApiPhp\Client;

class TransactionTest extends TestCase
{
    const TEST_API_KEY              = '';

    const TEST_TRANSACTION_ID       = '';

    const TEST_CREATE_ARGUMENTS     = array(
        'account'               => '',
        'amount'                => '10000',
        'card'                  => '',
        'customer_ip'           => '127.0.0.1',
        'dynamic_descriptor'    => 'Test transaction',
        'payment_product'       => 'card',
        'user_agent'            => 'SpryngPaymentsApiPhp/0.1'
    );

    protected $client;

    public function setUp()
    {
        $this->client = new Client(static::TEST_API_KEY, true);
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

    public function testCreateTransaction()
    {
        $transaction = $this->client->transaction->create(static::TEST_CREATE_ARGUMENTS);

        $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Transaction', $transaction);

        // Save arguments to variable so they don't have to be called statically.
        $args = static::TEST_CREATE_ARGUMENTS;

        // Validate transaction object
        $this->assertTrue($transaction->account->_id === $args['account']);
        $this->assertTrue($transaction->amount === (int) $args['amount']);
        $this->assertTrue($transaction->card->_id === $args['card']);
        $this->assertTrue($transaction->customer_ip === $args['customer_ip']);
        $this->assertTrue($transaction->dynamic_descriptor === $args['dynamic_descriptor']);
        $this->assertTrue($transaction->payment_product === $args['payment_product']);
        $this->assertTrue($transaction->user_agent === $args['user_agent']);
    }
}