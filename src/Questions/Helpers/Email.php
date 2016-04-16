<?php

namespace Questions\Helpers;

use Vendor\Container;

class Email
{
    public static function sendEmail($text, $id, $expert_id, $type,$to_exp = false)
    {
        $email_text = 'Hi! You have a ' . $type . ': ' . $text . '<br/>
                       Url: questions.com/' . $id;
        if ($to_exp) {
            $email_text .= '<br> Author of question: ' . $to_exp;
        }
        $subject = strtoupper($type);
        $to = $expert_id;
        Container::get('email')->send($email_text, $subject, $to);
    }
}