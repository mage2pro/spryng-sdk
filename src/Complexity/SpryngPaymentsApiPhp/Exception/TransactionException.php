<?php

namespace SpryngPaymentsApiPhp\Exception;

use SpryngPaymentsApiPhp\SpryngPaymentsException;

class TransactionException extends SpryngPaymentsException
{
    const NO_ACCOUNT_ON_RECORD          = 202;
}