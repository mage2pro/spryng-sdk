<?php

namespace SpryngPaymentsApiPhp\Helpers;
use SpryngPaymentsApiPhp\Helper;
use SpryngPaymentsApiPhp\Object\Account;
use SpryngPaymentsApiPhp\Processors\EMS;
use SpryngPaymentsApiPhp\Processors\GenericProcessor;
use SpryngPaymentsApiPhp\Processors\Klarna;
use SpryngPaymentsApiPhp\Processors\PayPal;
use SpryngPaymentsApiPhp\Processors\SlimPay;

/**
 * Class AccountHelper
 * @package SpryngPaymentsApiPhp
 */
class AccountHelper extends Helper
{

    /**
     * @param array $jsonObject
     * @return mixed
     */
    public static function fill($jsonObject)
    {
        $account = new Account();

        foreach($jsonObject as $key => $parameter)
        {
        	// 2017-04-04
			// Сегодня впервые случился сбой:
			// Undefined property: SpryngPaymentsApiPhp\Object\Account::$disabled
			// Видимо, в API что-то поменялось.
            if ( ! is_array(dfo($account, $key)) )
            {
                $account->$key = $parameter;
            }
            else
            {
                switch($key)
                {
                    case 'processors_configurations':
                        foreach($parameter as $configuration)
                        {
                            $type = $configuration->_type;
                            $account->processors_configurations[$type] = $configuration;
                        }
                        break;
                    case 'processors':
                        foreach($parameter as $processor)
                        {
                            array_push($account->processors, $processor);
                        }
                        break;
                }
            }
        }

        return $account;
    }

    /**
     * @param array $arguments
     * @return boolean
     */
    public static function validateCreateRequestArguments($arguments)
    {
        // TODO: Implement validateCreateRequestArguments() method.
    }
}