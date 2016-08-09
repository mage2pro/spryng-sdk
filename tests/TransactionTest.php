<?php

use PHPUnit\Framework\TestCase;
use SpryngPaymentsApiPhp\Client;

class TransactionTest extends TestCase
{
    const TEST_API_KEY = '8L0E94HxdHmApEoUggHbHgjQ7rdewcX1BxEXlKx_4Gw';

    public function testExceptionIsRaisedOnContruction()
    {
        new SpryngPaymentsApiPhp\Client(self::TEST_API_KEY);
    }
}