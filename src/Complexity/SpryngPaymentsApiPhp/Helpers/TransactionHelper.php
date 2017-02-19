<?php

namespace SpryngPaymentsApiPhp\Helpers;

use SpryngPaymentsApiPhp\Exception\TransactionException;
use SpryngPaymentsApiPhp\Object\Account;
use SpryngPaymentsApiPhp\Object\Card;
use SpryngPaymentsApiPhp\Object\Customer;
use SpryngPaymentsApiPhp\Object\Transaction;

class TransactionHelper
{

    static $SPECIAL_PARAMETERS = array(
        'details',
        'account',
        'card',
        'customer'
    );

    /**
     * Takes raw response object and returns formatted transaction object.
     *
     * @param $responseObj
     * @return Transaction
     */
    public static function fillTransaction($responseObj)
    {
        $transaction = new Transaction();

        foreach($responseObj as $key => $parameter)
        {
            if (!in_array($key, self::$SPECIAL_PARAMETERS) )
            {
                $transaction->$key = $parameter;
            }
            else
            {
                switch($key)
                {
                    case 'details':
                        $transaction->details = new \stdClass();
                        $transaction->details = $parameter;
                        break;
                    case 'account':
                        $transaction->account = new Account();
                        $transaction->account->_id = $parameter;
                        break;
                    case 'card':
                        $transaction->card = new Card();
                        $transaction->card->_id = $parameter;
                        break;
                    case 'customer':
                        $transaction->customer = new Customer();
                        $transaction->customer->_id = $parameter;
                }
            }
        }

        return $transaction;
    }

    /**
	 * @used-by \SpryngPaymentsApiPhp\Controller\TransactionController::create()
     * @param array(string => mixed) $a
	 * @return (string => mixed)
     * @throws TransactionException
     */
    public static function validateCreate(array $a)
    {
        if (!isset($a['account']))
        {
            throw new TransactionException("Account ID is not set.", 203);
        }

        if (!isset($a['amount']))
        {
            throw new TransactionException("Amount not provided", 203);
        }

        if (!isset($a['card']))
        {
            throw new TransactionException("Card token not provided.", 203);
        }

        if (!isset($a['customer_ip']))
        {
            throw new TransactionException("Customer IP not provided.", 203);
        }

        if (filter_var($a['customer_ip'], FILTER_VALIDATE_IP) === false)
        {
            throw new TransactionException("Customer IP is not a valid IP address.", 204);
        }

        if (!isset($a['dynamic_descriptor']))
        {
            throw new TransactionException("Dynamic descriptor not provided.", 203);
        }

        if (!isset($a['payment_product']))
        {
            throw new TransactionException("Payment product not provided.", 203);
        }

        if (isset($a['user_agent']))
        {
            if (!is_string($a['user_agent']))
            {
                throw new TransactionException("User agent is not a string.", 205);
            }
        }
        return $a;
    }
}