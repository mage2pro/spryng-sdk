<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace Spryng_PaymentsApiPhp\Object;

/**
 * Class Spryng_Payments_Api_Object_Refund
 * @package SpryngPaymentsApiPhp\Object
 */
class Spryng_Payments_Api_Object_Refund
{
    /**
     * Gateway generated value for identifying individual chargebacks.
     *
     * @var string
     */
    public $_id;

    /**
     * The account object representing the refund.
     *
     * @var Spryng_Payments_Api_Object_Account
     */
    public $account;

    /**
     * Refund amount.
     *
     * @var integer
     */
    public $amount;

    /**
     * Indicates the reason for the refund.
     *
     * @var string
     */
    public $reason_code;

    /**
     * The latest status of the chargeback.
     *
     * @var string
     */
    public $status;

    /**
     * Object representing the original transaction.
     *
     * @var Spryng_Payments_Api_Object_Transaction
     */
    public $transaction;
}