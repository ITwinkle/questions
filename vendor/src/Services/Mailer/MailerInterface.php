<?php

namespace Vendor\Services\Mailer;

class MailerInterface
{
    public function send($text,$subject,$to){}
}