<?php
namespace App\Classes;

class ErrCode{
    static public $Success=0;
    static public $Fail=-1;

    static private $msg=[
      '0'=>"操作成功",
        '-1'=>"失败",
        ''
    ];

    static private $UnknowError = '未知错误';

    static function CodeToMsg($code){
        if (array_key_exists($code,self::$msg)){
            return self::$msg[$code];
        }
        return self::$UnknowError;
    }
}
