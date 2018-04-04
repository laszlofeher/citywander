<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



if (!function_exists('sentencetruncate')) {
    function sentencetruncate($str, $len) {
      $tail = max(0, $len-10);
      $trunk = substr($str, 0, $tail);
      $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len-$tail))));
      return $trunk;
    }
}

if (!function_exists('markedsearchedtext')) {
    function markedsearchedtext($str, $search) {
        return mb_eregi_replace($search, '<mark>'.$search.'</mark>', $str);        
    }
}

/**
     * Kétszintű regisztrációhoz szükséges, metodus.
     * A felhasználó id alapján generál egy egyedi azonosítót.
     * Egy véletlenszám és az id md5 hash-e, azért ilyen gyenge
     * a hash képzés, mert legrosszabb esetben az id-ja derül 
     * ki a felhasználónak.
     * @param type $registreduser_id
     */
if (!function_exists('checkeduserGenerate')) {
    function checkeduserGenerate($registreduser_id = -1, $length = 10) {
        $length = (int)$length;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString .= md5($registreduser_id);
        return $randomString;
    }
}
?>