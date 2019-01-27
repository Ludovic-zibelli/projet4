<?php
namespace App\Utils;

class Strings{
    private $length;

    public function __construct(string $length){
        $this->length = $length;
    }

    public function getRandomString(){
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $bookingnumber = '';
        for($i=0; $i<$this->length; $i++){
            $bookingnumber .= $chars[rand(0, strlen($chars)-1)];
        }
        return $bookingnumber;
    }
}