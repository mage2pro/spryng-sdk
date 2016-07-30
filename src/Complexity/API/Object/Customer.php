<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace DimeboxApiPhp\Object;

/**
 * Class Dimebox_Api_Object_Customer
 * @package DimeboxApiPhp\Object
 */
class Dimebox_Api_Object_Customer
{
    /**
     * Generated by the gateway when the customer is created.
     *
     * @var string
     */
    public $customer_id;

    /**
     * A metadata field available for storing additional information in the customer object.
     *
     * @var string
     */
    public $merchant_reference;

    /**
     * Transactions submitted with only the customer ID will use the customers default card id to charge the customer.
     *
     * @var Dimebox_Api_Object_Card
     */
    public $default_card;

    /**
     * Lists all cards associated to the customer.
     *
     * @var array[Dimebox_Api_Object_Card]
     */
    public $cards;

    /**
     * First name of the customer.
     *
     * @var string
     */
    public $first_name;

    /**
     * Last name of the customer.
     *
     * @var string
     */
    public $last_name;

    /**
     * Mobile contact for the customer.
     *
     * @var string
     */
    public $mobile;

    /**
     * Local phone contact for the customer.
     *
     * @var string
     */
    public $phone;

    /**
     * Email address of the customer.
     *
     * @var string
     */
    public $email;

    /**
     * A customer can have many address objects. e.g. Shipping, Billing, Office or Home.
     *
     * @var Dimebox_Api_Object_Customer_Address
     */
    public $address;

    /**
     * Customer tax number.
     *
     * @var string
     */
    public $tax_number;

    /**
     * The id of the organisation to which a customer belongs.
     *
     * @var string
     */
    public $organisation;

}