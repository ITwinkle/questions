<?php

namespace Questions\Helpers;

use Vendor\Container;

class Email
{
    public static function sendEmail($text, $id, $email, $type,$to_exp = false)
    {
        $email_text = 'Hi! You have a ' . $type . ':
         ' . $text . '
         Url: questions.com/' . $id;
        if ($to_exp) {
            $email_text .= '! Author of question: ' . $to_exp;
        }
        $subject = strtoupper($type);
        $to = $email;
        Container::get('email')->send($email_text, $subject, $to);
    }
}