<?php

require_once('BaseTest.php');

class iDealTest extends BaseTest
{
    const TEST_INITIATE_ARGUMENTS = array(
        'account' => self::TEST_ACCOUNT_ID,
        'amount' => 1000,
        'customer_ip' => '127.0.0.1',
        'dynamic_descriptor' => 'Test iDeal Transaction',
        'user_agent' => 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0)',
        'details' => [
            'issuer' => 'INGBNL2A',
            'redirect_url' => 'https://spryngpayments.com/redirect/ideal',
        ]
    );

    public function testInitiateiDealTransaction()
    {
        $transaction = $this->client->iDeal->initiate(static::TEST_INITIATE_ARGUMENTS);

        $this->assertNotFalse(filter_var($transaction->details->approval_url, FILTER_VALIDATE_URL));
    }
}