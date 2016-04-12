<?php

namespace Questions\Helpers;

class Random
{
    public static function random_string($length, $chartypes)
    {
        $chartypes_array = explode(",", $chartypes);

        $lower = 'abcdefghijklmnopqrstuvwxyz';
        $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '1234567890';
        $chars = "";

        if (in_array('all', $chartypes_array)) {
            $chars = $lower . $upper . $numbers;
        } else {
            if (in_array('lower', $chartypes_array)) {
                $chars = $lower;
            }
            if (in_array('upper', $chartypes_array)) {
                $chars .= $upper;
            }
            if (in_array('numbers', $chartypes_array)) {
                $chars .= $numbers;
            }
        }

        $chars_length = strlen($chars) - 1;
        $string = $chars{rand(0, $chars_length)};
        for ($i = 1; $i < $length; $i = strlen($string)) {
            $random = $chars{rand(0, $chars_length)};
            if ($random != $string{$i - 1})
                $string .= $random;
        }

        return $string;
    }
}