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

class MailerInterface
{
    /**
     * Send message
     *
     * @param $text - message
     * @param $subject - mail subject
     * @param $to - destination email
     */
    public function send($text, $subject, $to)
    {
    }
}