<?php

/**
 *  Response interface
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor\Response;

interface ResponseInterface
{
    /**
     * Send response
     */
    public function send();
}