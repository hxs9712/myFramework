<?php

namespace App\Controller;

use App\Classes\CommonFun;
use Illuminate\Database\Capsule\Manager as DB;


class DatabaseController extends BaseController
{
    /**
     * 插入数据
     *
     */
    function insertData()
    {
        $start = CommonFun::formatMicrotime();
        for ($n = 0; $n < 10000; $n++) {
            $data = [];
            for ($i = 0; $i < 1000; $i++) {
                $data[] = ['f1' => '....', 'f2' => '....', 'f3' => '....'];
            }


            DB::table('test')->insert($data);
        }
        echo CommonFun::formatMicrotime() - $start;
        //24.869472026825
        //23.2
    }
}
