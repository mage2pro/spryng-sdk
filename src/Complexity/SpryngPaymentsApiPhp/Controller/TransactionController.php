<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Exception\TransactionException;
use SpryngPaymentsApiPhp\Helpers\TransactionHelper;
use SpryngPaymentsApiPhp\Object\Transaction;
use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Utility\RequestHandler;

/**
 * Class TransactionController
 * @package SpryngPaymentsApiPhp\Controller
 */
class TransactionController extends BaseController
{

    const TRANSACTION_URI = "/transaction";

    const REFUND_TRANSACTION_URI = "/refund";

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
     * (partly) Refund a transaction
     *
     * @param $transactionId
     * @param null $amount
     * @param null $reason
     * @return bool
     * @throws TransactionException
     * @throws \SpryngPaymentsApiPhp\Exception\RequestException
     */
    public function refund($transactionId, $amount = null, $reason = null)
    {
        $queryString = self::TRANSACTION_URI . '/'. $transactionId . self::REFUND_TRANSACTION_URI;
        $arguments = array();

        if (is_null($amount))
        {
            $amount = $this->getTransactionById($transactionId)->amount;
        }
        $arguments['amount'] = $amount;

        if ($reason != '' && !is_null($reason))
        {
            $arguments['reason'] = $reason;
        }

        $http = new RequestHandler();
        $http->setHttpMethod("POST");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString($queryString);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->setPostParameters($arguments);
        $http->doRequest();

        return $http->getResponseCode() == 200 ? true : false;
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
            $transaction = TransactionHelper::fillTransaction($jsonResponse[0]);
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

        $response = $http->getResponse();

        $jsonResponse = json_decode($response);
        $newTransaction = TransactionHelper::fillTransaction($jsonResponse);

        return $newTransaction;
    }
}