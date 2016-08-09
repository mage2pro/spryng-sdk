<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Object\Transaction;
use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Utility\RequestHandler;

/**
 * Class Spryng_Payments_Api_Controller_Transaction
 * @package SpryngPaymentsApiPhp\Controller
 */
class TransactionController extends BaseController
{

    const TRANSACTION_URI = "/transaction";

    /**
     * Global request handler instance
     *
     * @var RequestHandler
     */
    public $requestHandler;

    /**
     * Spryng_Payments_Api_Controller_Transaction constructor.
     * @param Client $api
     */
    public function __construct(Client $api)
    {
        parent::__construct($api);

        $this->requestHandler = new RequestHandler();
        $this->requestHandler->addHeader($this->api->getApiKey(), 'X-APIKEY', false);
    }

    /**
     * @return array
     */
    public function getAll()
    {

        $this->requestHandler->setHttpMethod("GET");
        $this->requestHandler->setBaseUrl($this->api->getApiEndpoint());
        $this->requestHandler->setQueryString(static::TRANSACTION_URI);
        $this->requestHandler->doRequest();

        $response = $this->requestHandler->getResponse();

        $jsonResponse = json_decode($response);

        $transactions = array();

        foreach($jsonResponse as $key => $transaction)
        {
            //TODO Parse transactions

            $transactionObj = new Transaction();
            $transactionObj->_id = $transaction['_id'];

            array_push($transactions, $transaction);
        }

        return $response;
    }
}