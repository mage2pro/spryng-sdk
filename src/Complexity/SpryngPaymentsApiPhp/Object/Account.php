<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp\Object;

/**
 * Class Account
 * @package SpryngPaymentsApiPhp\Object
 */
class Account
{
    /**
     * The ID of the account
     *
     * @var string
     */
    public $_id;

    /**
     * An optional organisation
     *
     * @var string
     */
    public $organisation;

    /**
     * Name of the account or account holder
     *
     * @var string
     */
    public $name;

    /**
     * ISO currency code
     *
     * @var string
     */
    public $currency_code;

    /**
     * Fee for chargebacks
     *
     * @var float
     */
    public $chargeback_fee;

    /**
     * Monthly fee for holding the account
     *
     * @var int
     */
    public $monthly_fee;

    /**
     * Fee for refunds
     *
     * @var float
     */
    public $refund_fee;

    /**
     * @var float
     */
    public $transacion_fee_fixed;

    /**
     * @var float
     */
    public $transaction_fee_percentage;

    /**
     * @var array
     */
    public $processors_configurations;

    /**
     * @var array
     */
    public $processors;

}