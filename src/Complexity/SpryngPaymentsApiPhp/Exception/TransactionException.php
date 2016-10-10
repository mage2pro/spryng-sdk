<?php

namespace SpryngPaymentsApiPhp\Exception;

use SpryngPaymentsApiPhp\SpryngPaymentsException;

/**
 * Class TransactionException
 * @package SpryngPaymentsApiPhp\Exception
 */
class TransactionException extends SpryngPaymentsException
{
    const NO_ACCOUNT_ON_RECORD          = 201;
    const TRANSACTION_NOT_FOUND         = 202;
    const INVALID_TRANSACTION_ARGUMENTS = 203;
    const CUSTOMER_IP_IS_NOT_VALID      = 204;
    const USER_AGENT_INVALID_TYPE       = 205;
}