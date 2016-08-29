<?php

namespace SpryngPaymentsApiPhp\Helpers;

use SpryngPaymentsApiPhp\Exception\TransactionException;
use SpryngPaymentsApiPhp\Object\Account;
use SpryngPaymentsApiPhp\Object\Card;
use SpryngPaymentsApiPhp\Object\Customer;
use SpryngPaymentsApiPhp\Object\Transaction;

class TransactionHelper
{
    /**
     * Takes raw response object and returns formatted transaction object.
     *
     * @param $responseObj
     * @return Transaction
     */
    public static function fillTransaction($responseObj)
    {
        $obj = new Transaction();
        $obj->_id                       = (isset($responseObj->_id)) ? $responseObj->_id : null;
        $obj->amount                    = (isset($responseObj->amount)) ? $responseObj->amount : null;
        $obj->arn                       = (isset($responseObj->arn)) ? $obj->arn = $responseObj->arn : $obj->arn = null;
        $obj->authorization_code        = (isset($responseObj->authorization_code)) ? $responseObj->authorization_code : null;
        $obj->avs_result                = (isset($responseObj->avs_result)) ? $responseObj->avs_result : null;
        $obj->cavv2                     = (isset($responseObj->cavv2)) ? $responseObj->cavv2 : null;
        $obj->country_code              = (isset($responseObj->country_code)) ? $responseObj->country_code : null;;
        $obj->created_at                = (isset($responseObj->created_at)) ? new \DateTime($responseObj->created_at) : null;
        $obj->customer_ip               = (isset($responseObj->customer_ip)) ? $responseObj->customer_ip : null;
        $obj->cvv_present               = (isset($responseObj->cvv_present)) ? $responseObj->cvv_present : null;
        $obj->cvv_response              = (isset($responseObj->cvv_response)) ? $responseObj->cvv_response : null;
        $obj->dynamic_descriptor        = (isset($responseObj->dynamic_descriptor)) ? $responseObj->dynamic_descriptor : null;
        $obj->eci_code                  = (isset($responseObj->eci_cod)) ? $responseObj->eci_code : null;
        $obj->geo_location              = (isset($responseObj->geo_location)) ? $responseObj->geo_location : null;
        $obj->interchange_fixed         = (isset($responseObj->interchange_fixed)) ? $responseObj->interchange_fixed : null;
        $obj->interchange_percentage    = (isset($responseObj->interchange_percentage)) ? $responseObj->interchange_percentage : null;
        $obj->merchant_reference        = (isset($responseObj->merchant_reference)) ? $responseObj->merchant_reference : null;
        $obj->payment_product           = (isset($responseObj->payment_product)) ? $responseObj->payment_product : null;
        $obj->payment_product_type      = (isset($responseObj->payment_product_type)) ? $responseObj->payment_product_type : null;
        $obj->pos_entry_mode_id         = (isset($responseObj->pos_entry_mode_id)) ? $responseObj->pos_entry_mode_id : null;
        $obj->threed_enrolled           = (isset($responseObj->threed_enrolled)) ? $responseObj->threed_enrolled : null;
        $obj->threed_authenticated      = (isset($responseObj->threed_authenticated)) ? $responseObj->threed_authenticated : null;
        $obj->stan                      = (isset($responseObj->stan)) ? $responseObj->stan : null;
        $obj->status                    = (isset($responseObj->status)) ? $responseObj->status : null;
        $obj->user_agent                = (isset($responseObj->user_agent)) ? $responseObj->user_agent : null;

        if (isset($responseObj->account))
        {
            $obj->account = new Account();
            $obj->account->_id = $responseObj->account;
        }

        if (isset($responseObj->card))
        {
            $obj->card = new Card();
            $obj->card->_id = $responseObj->card;
        }

        if (isset($responseObj->customer))
        {
            $obj->customer = new Customer();
            $obj->customer->customer_id = $responseObj->customer_id;
        }

        return $obj;
    }

    public static function validateNewTransactionArguments($arguments)
    {
        if (!isset($arguments['account']))
        {
            throw new TransactionException("Account ID is not set.", 203);
        }

        if (!isset($arguments['amount']))
        {
            throw new TransactionException("Amount not provided", 203);
        }

        if (!isset($arguments['card']))
        {
            throw new TransactionException("Card token not provided.", 203);
        }

        if (!isset($arguments['customer_ip']))
        {
            throw new TransactionException("Customer IP not provided.", 203);
        }

        if (filter_var($arguments['customer_ip'], FILTER_VALIDATE_IP) === false)
        {
            throw new TransactionException("Customer IP is not a valid IP address.", 204);
        }

        if (!isset($arguments['dynamic_descriptor']))
        {
            throw new TransactionException("Dynamic descriptor not provided.", 203);
        }

        if (!isset($arguments['payment_product']))
        {
            throw new TransactionException("Payment product not provided.", 203);
        }

        if (isset($arguments['user_agent']))
        {
            if (!is_string($arguments['user_agent']))
            {
                throw new TransactionException("User agent is not a string.", 205);
            }
        }
    }
}