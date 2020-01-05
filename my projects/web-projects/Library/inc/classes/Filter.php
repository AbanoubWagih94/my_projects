<?php

if(!defined("__CONFIG__")){
    exit("You don\'t have config file");
}
class Filter
{
    public static function String($string, $html = false) {
        if(!$html){
            $string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        } else {
            $string = filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        return $string;
    }
    public static function Email($email) {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    public static function URL ($url) {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    public static function Int ($int) {
        return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
    }


}