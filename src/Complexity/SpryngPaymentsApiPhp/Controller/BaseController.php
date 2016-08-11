<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp\Controller;

use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Utility\RequestHandler;

/**
 * Class Spryng_Payments_Api_Controller_BaseController
 * @package SpryngPaymentsApiPhp\Controller
 */
class BaseController
{
    /**
     * @var Client
     */
    protected $api;

    public function __construct(Client $api)
    {
        $this->api = $api;
    }
}