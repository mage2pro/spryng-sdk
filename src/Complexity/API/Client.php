<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp;

use SpryngPaymentsApiPhp\Controller\Spryng_Payments_Api_Controller_Transaction;

class Spryng_Payments_Api_Client
{
    const CLIENT_VERSION = "1.0";

    const API_ENDPOINT = "https://spryng.dimebox.com";

    /**
     * @var string
     */
    protected $apiEndpoint = self::API_ENDPOINT;

    /**
     * Public instance of the Transaction Controller
     *
     * @var Spryng_Payments_Api_Controller_Transaction;
     */
    public $transaction;

    /**
     * API key to authenticate user
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Spryng_Payments_Api_Client constructor.
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->setApiKey($apiKey);

        $this->transaction = new Spryng_Payments_Api_Controller_Transaction($this);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }
}