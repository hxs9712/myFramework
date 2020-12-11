<?php

namespace App\Controller;

use App\Classes\CommonFun;

class ArrayController extends BaseController
{
    //笛卡尔积（适用于sku商品型号组合）
    public function cartesian()
    {
        $properties = [
            'color'=> ['白色'],
            'stat'=> ['透气','防滑'],
            'size'=>['37码'],
            'jr'=>['加绒','不加绒'],
            'sex'=>['男款','女款']
        ];

        $properties_category = array_keys($properties);
        $properties_values = array_values($properties);

        $start = CommonFun::formatMicrotime();

        $res = $this->cartesianQuickFun($properties_values, 0, count($properties_values) - 1);

        foreach ($res as $key=>$v){
            $v = explode(',',$v);
            $res[$key]=[];
            foreach ($v as $key2=>$item){
                $res[$key][$properties_category[$key2]] = $item;
            }
        }
        echo "<pre>";
        var_dump($res);
        echo CommonFun::formatMicrotime() - $start;

    }

    //用时17秒
    function cartesianEasyFun($array)
    {
        $res = $array[0];
        for ($i = 1; $i < count($array); $i++) {
            $tmp = [];
            foreach ($array[$i] as $value) {
                foreach ($res as $value2) {
                    $tmp [] = $value . $value2;
                }
            }
            $res = $tmp;
        }

        echo "<pre>";
//        var_dump($res);
    }

    //分治法快速组合（用时6秒）
    function cartesianQuickFun(&$array, $start, $end)
    {

        if ($start >= $end) {
            return $array[$start];
        }

        $middle = intval(($start + $end) / 2);
        $res1 = $this->cartesianQuickFun($array, $start, $middle);
        $res2 = $this->cartesianQuickFun($array, $middle + 1, $end);

        foreach ($res1 as $value) {
            foreach ($res2 as $value2) {
                $res[] =$value.','.$value2;
            }
        }

        return $res;
    }
}
