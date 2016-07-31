<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Spryng_Payments_Api_Client;

/**
 * Class Spryng_Payments_Api_Controller_BaseController
 * @package SpryngPaymentsApiPhp\Controller
 */
class Spryng_Payments_Api_Controller_BaseController
{

    /**
     * @var Spryng_Payments_Api_Client
     */
    protected $api;

    /**
     * @var string
     */
    protected $resourcePath;

    public function __construct(Spryng_Payments_Api_Client $api)
    {
        $this->api = $api;

        if (empty($this->resourcePath))
        {
            $class_parts         = explode("_", get_class($this));
            $this->resourcePath = strtolower(end($class_parts));
        }
    }
}