<?php

namespace Vendor\Services;


class Email
{
    public static function send($text,$subject,$to){
        mail($text,$subject,$to);
    }
}