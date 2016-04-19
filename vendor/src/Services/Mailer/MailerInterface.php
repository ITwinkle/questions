<?php

/**
 *  Mailer interface
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor\Services\Mailer;

interface MailerInterface
{
    /**
     * Send message
     *
     * @param $text - message
     * @param $subject - mail subject
     * @param $to - destination email
     */
    public static function send($text, $subject, $to);
}