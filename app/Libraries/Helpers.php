<?php

//namespace App;

class Helpers 
{


public static function shortenString($string, $len = 150) {
        if (strlen($string) > $len) {
            $string = trim(substr($string, 0, $len));
            $string = substr($string, 0, strrpos($string, " "))."&hellip;";
        } else {
            $string .= "&hellip;";
        }
        return $string;
    }
}