<?php

/**
 * Validator class
 *
 * @package    app
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor;

class Validator
{
    /**
     * Check min size of string
     *
     * @param $string
     * @param integer $min
     * @return bool
     */
    public function minSize($string, $min)
    {
        if (strlen($string) < $min) {
            return false;
        }
        return true;
    }
}