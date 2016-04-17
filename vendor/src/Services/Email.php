<?php

namespace Vendor\Services;


use Vendor\Application;

class Email
{
    public static function send($text,$subject,$to){
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername(Application::$config['swiftmailer']['username'])
            ->setPassword(Application::$config['swiftmailer']['password']);
        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance('Question')
            ->setFrom('anishchenko.igor@gmail.com')
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($text);

        $mailer->send($message);
    }
}