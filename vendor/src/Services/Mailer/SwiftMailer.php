<?php

/**
 *  SwiftMailer class
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor\Services\Mailer;

use Vendor\Application;

class SwiftMailer
{
    /**
     * @inheritdoc
     */
    public static function send($text,$subject,$to){
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername(Application::$config['swiftmailer']['username'])
            ->setPassword(Application::$config['swiftmailer']['password']);
        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance('Question')
            ->setFrom('anishchenko.igor@gmail.com')
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($text)
            ->setContentType('text/html');

        $mailer->send($message);
    }
}