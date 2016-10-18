<?php

use PHPUnit\Framework\TestCase;
use SpryngPaymentsApiPhp\Client;

class CardTest extends TestCase
{
    const TEST_API_KEY              = '';

    const TEST_CREATE_ARGUMENTS     = array(
        'card_number'   => '4024007108173153',
        'cvv'           => '123',
        'expiry_month'  => '12',
        'expiry_year'   => '17'
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

    public function testCreateCard()
    {
        $card = $this->client->card->create(static::TEST_CREATE_ARGUMENTS);

        $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Card', $card);
    }

}