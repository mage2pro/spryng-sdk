<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Exception\TransactionException;
use SpryngPaymentsApiPhp\Helpers\TransactionHelper;
use SpryngPaymentsApiPhp\Object\Account;
use SpryngPaymentsApiPhp\Object\Card;
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

    const ACCOUNT_SEARCH_URI = '/account?_id=';

    /**
     * Spryng_Payments_Api_Controller_Transaction constructor.
     * @param Client $api
     */
    public function __construct(Client $api)
    {
        parent::__construct($api);
    }

    /**
     * @return array
     */
    public function getAll()
    {

        $http = new RequestHandler();
        $http->setHttpMethod("GET");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::TRANSACTION_URI);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->doRequest();

        $response = $http->getResponse();

        $jsonResponse = json_decode($response);

        $transactions = array();

        foreach($jsonResponse as $key => $transaction)
        {
            $transactionObj = TransactionHelper::fillTransaction($transaction);

            array_push($transactions, $transactionObj);
        }

        return $transactions;
    }

    /**
     * @param $id
     * @return Transaction
     * @throws TransactionException
     */
    public function getTransactionById($id)
    {
        $http = new RequestHandler();
        $http->setHttpMethod("GET");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::TRANSACTION_URI.'?_id='.$id);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->doRequest();

        $response = $http->getResponse();

        $jsonResponse = json_decode($response);

        if (count($jsonResponse) > 0)
        {
            $transaction = TransactionHelper::fillTransaction($jsonResponse);
        }
        else
        {
            throw new TransactionException("Transaction not found", 202);
        }

        return $transaction;
    }

    /**
     * @param $arguments
     * @return Transaction
     * @throws TransactionException
     * @throws \SpryngPaymentsApiPhp\Exception\RequestException
     */
    public function create($arguments)
    {
        TransactionHelper::validateNewTransactionArguments($arguments);

        $http = new RequestHandler();
        $http->setHttpMethod("POST");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::TRANSACTION_URI);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->setPostParameters($arguments, false);
        $http->doRequest();

        $reponse = $http->getResponse();

        $jsonResponse = json_decode($reponse);
        $newTransaction = TransactionHelper::fillTransaction($jsonResponse);

        return $newTransaction;
    }
}