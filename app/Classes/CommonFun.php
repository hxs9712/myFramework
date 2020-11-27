<?php
namespace App\Classes;

class CommonFun{
    static function formatMicrotime(){
        list($msec, $sec) = explode(' ', microtime());
        $formatT = sprintf("%f",($sec+$msec));

        return $formatT;
    }
}
