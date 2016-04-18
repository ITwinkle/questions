<?php

/**
 *  Email helper
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Helpers;

use Vendor\Container;
use Vendor\View;

class Email
{
    /**
     * @param $text mail message
     * @param $id
     * @param $email
     * @param $type
     * @param bool $to_exp
     * @throws \Vendor\Exception
     */
    public static function sendEmail($text, $id, $email, $type, $to_exp = false)
    {
        if ($to_exp) {
            $email_text = (new View())->render(View::$renderPath . 'Email/expert.php', ['text' => $text, 'url' => $id, 'author' => $to_exp]);
        } else {
            $email_text = (new View())->render(View::$renderPath . 'Email/user.php', ['text' => $text, 'url' => $id]);
        }
        $subject = strtoupper($type);
        $to = $email;
        Container::get('email')->send($email_text, $subject, $to);
    }
}