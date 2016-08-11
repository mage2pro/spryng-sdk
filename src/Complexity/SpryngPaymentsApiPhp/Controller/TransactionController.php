<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Object\Account;
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
        $http->doRequest();

        $response = $http->getResponse();

        $jsonResponse = json_decode($response);

        $transactions = array();

        foreach($jsonResponse as $key => $transaction)
        {
            $obj = new Transaction();
            $obj->_id                       = (isset($transaction->_id)) ? $transaction->_id : null;
            $obj->account                   = (isset($transaction->account)) ? $transaction->account : null;
            $obj->amount                    = (isset($transaction->amount)) ? $transaction->amount : null;
            $obj->arn                       = (isset($transaction->arn)) ? $transaction->arn : null;
            $obj->authorization_code        = (isset($transaction->authorization_code)) ? $transaction->authorization_code : null;
            $obj->avs_result                = (isset($transaction->avs_result)) ? $transaction->avs_result : null;
            $obj->card                      = (isset($transaction->card)) ? $transaction->card : null;
            $obj->cavv2                     = (isset($transaction->cavv2)) ? $transaction->cavv2 : null;
            $obj->country_code              = (isset($transaction->country_code)) ? $transaction->country_code : null;;
            $obj->created_at                = (isset($transaction->created_at)) ? new \DateTime($transaction->created_at) : null;
            $obj->customer                  = (isset($transaction->customer)) ? $transaction->customer : null;
            $obj->customer_ip               = (isset($transaction->customer_ip)) ? $transaction->customer_ip : null;
            $obj->cvv_present               = (isset($transaction->cvv_present)) ? $transaction->cvv_present : null;
            $obj->cvv_response              = (isset($transaction->cvv_response)) ? $transaction->cvv_response : null;
            $obj->dynamic_descriptor        = (isset($transaction->dynamic_descriptor)) ? $transaction->dynamic_descriptor : null;
            $obj->eci_code                  = (isset($transaction->eci_cod)) ? $transaction->eci_code : null;
            $obj->geo_location              = (isset($transaction->geo_location)) ? $transaction->geo_location : null;
            $obj->interchange_fixed         = (isset($transaction->interchange_fixed)) ? $transaction->interchange_fixed : null;
            $obj->interchange_percentage    = (isset($transaction->interchange_percentage)) ? $transaction->interchange_percentage : null;
            $obj->merchant_reference        = (isset($transaction->merchant_reference)) ? $transaction->merchant_reference : null;
            $obj->payment_product           = (isset($transaction->payment_product)) ? $transaction->payment_product : null;
            $obj->payment_product_type      = (isset($transaction->payment_product_type)) ? $transaction->payment_product_type : null;
            $obj->pos_entry_mode_id         = (isset($transaction->pos_entry_mode_id)) ? $transaction->pos_entry_mode_id : null;
            $obj->threed_enrolled           = (isset($transaction->threed_enrolled)) ? $transaction->threed_enrolled : null;
            $obj->threed_authenticated      = (isset($transaction->threed_authenticated)) ? $transaction->threed_authenticated : null;
            $obj->stan                      = (isset($transaction->stan)) ? $transaction->stan : null;
            $obj->status                    = (isset($transaction->status)) ? $transaction->status : null;
            $obj->user_agent                = (isset($transaction->user_agent)) ? $transaction->user_agent : null;

            array_push($transactions, $obj);
        }

        return $transactions;
    }
}