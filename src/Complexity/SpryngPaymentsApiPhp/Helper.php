<?php

namespace SpryngPaymentsApiPhp;

/**
 * Abstract class for helper classes
 *
 * Class Helper
 * @package SpryngPaymentsApiPhp
 */
abstract class Helper
{
    /**
     * Fills an object from a given json response
     *
     * @param array $jsonObject
     * @return mixed
     */
    public static function fill($jsonObject) {return null;}

    /**
     * Validates if a create request is complete and valid
     *
     * @param array $arguments
     * @return boolean
     */
    public static function validateCreateRequestArguments($arguments) {return false;}
}