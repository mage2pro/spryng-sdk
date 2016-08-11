<?php

namespace SpryngPaymentsApiPhp\Exception;

use SpryngPaymentsApiPhp\SpryngPaymentsException;

class RequestException extends SpryngPaymentsException
{
    const INVALID_RESPONSE          = 101;
}