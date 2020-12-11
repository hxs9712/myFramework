<?php

namespace App\Controller;

use App\Classes\CommonFun;
use App\Concacts\SortConcact;


class AlgorithmController extends BaseController implements SortConcact
{
    function sort()
    {
        $arr = [];
        for ($i = 0; $i < 1000000; $i++) {
            $arr[] = rand(0, 999999);
        }
        $start = CommonFun::formatMicrotime();
        sort($arr);
        echo CommonFun::formatMicrotime() - $start;
        echo "<br>";
//        return $this->success($arr);
    }

    //冒泡排序
    function bubSort()
    {
        $arr = [];
        for ($i = 0; $i < 10000; $i++) {
            $arr[] = rand(0, 999999);
        }
        $start = CommonFun::formatMicrotime();
        for ($i = 0; $i < count($arr); $i++) {
            for ($j = $i + 1; $j < count($arr); $j++) {
                if ($arr[$i] > $arr[$j]) {
                    $tmp = $arr[$j];
                    $arr[$j] = $arr[$i];
                    $arr[$i] = $tmp;
                }
            }
        }
        echo CommonFun::formatMicrotime() - $start;
//        echo "<br>";
//        return $this->success($arr);
    }


    //插入排序
    public function insertSort()
    {
        // TODO: Implement insertSort() method.
        echo "<pre>";
        $arr = [];
        for ($i = 0; $i < 100000; $i++) {
            $arr[] = rand(0, 999999);
        }
        $start = CommonFun::formatMicrotime();

        for ($i = 1; $i < count($arr); $i++) {
            $tmp = $arr[$i];

            for ($j = $i - 1; $j >= 0; $j--) {
                if ($tmp < $arr[$j]) {
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $tmp;
                } else {
                    break;
                }
            }
        }

        echo CommonFun::formatMicrotime() - $start;
        echo "<br>";
//        return $this->success($arr);

    }

    //合并排序调用
    function mergeSort()
    {
        set_time_limit(0);
        ini_set("memory_limit", "2048M");
        //0.237169
        $arr = [];
        for ($i = 0; $i < 10000000; $i++) {
            $arr[] = rand(0, 999999);
        }

        $start = CommonFun::formatMicrotime();
        $this->mergeSortFun($arr, 0, count($arr) - 1);
        echo CommonFun::formatMicrotime() - $start;
        echo "<br>";
//        $this->success($arr);
    }

    //合并排序方法
    function mergeSortFun(&$arr, $start, $end)
    {
        //如果拆解到最小，结束
        if ($start >= $end) {
            return;
        }

        $middle = intval(($start + $end) / 2);
        $this->mergeSortFun($arr, $start, $middle); //左边继续拆解
        $this->mergeSortFun($arr, $middle + 1, $end);//右边继续拆解

        $i = $start;
        $j = $middle + 1;

        $arrTmp = [];
        while ($i <= $middle && $j <= $end) {
            if ($arr[$i] >= $arr[$j]) {
                $arrTmp[] = $arr[$i];
                $i++;
            } else {
                $arrTmp[] = $arr[$j];
                $j++;
            }
        }

        while ($i <= $middle) {
            $arrTmp[] = $arr[$i];
            $i++;
        }

        while ($j <= $end) {
            $arrTmp[] = $arr[$j];
            $j++;
        }

        $i = $start;

        foreach ($arrTmp as $value) {
            $arr[$i] = $value;
            $i++;
        }
    }


    function aa(){
        set_time_limit(0);
        ini_set("memory_limit", "2048M");
        //0.237169
        $arr = [];
        for ($i = 0; $i < 1000000; $i++) {
            $arr[] = rand(0, 999999);
        }

        $start = CommonFun::formatMicrotime();
        $this->aaFun($arr);
        echo CommonFun::formatMicrotime() - $start;
    }

    function aaFun($arr)
    {
        if (count($arr)<2){
            return $arr;
        }

        $middle = $arr[0];
        $left_arr = [];
        $right_arr = [];

        unset($arr[0]);
        foreach ($arr as $value){
            if ($value<$middle){
                $left_arr[] = $value;
            }else{
                $right_arr[] = $value;
            }
        }

        $left_arr = $this->aaFun($left_arr);
        $right_arr = $this->aaFun($right_arr);

        return array_merge($left_arr,[$middle],$right_arr);
    }

    //快速排序
    function quickSort()
    {
        //0.237169
        $arr = [];
        for ($i = 0; $i < 1000000; $i++) {
            $arr[] = rand(0, 999999);
        }

        $start = CommonFun::formatMicrotime();
        $result = $this->quickSortfun($arr);
        echo CommonFun::formatMicrotime() - $start;

//        $this->success($result);
    }

    //快速排序方法
    function quickSortfun($a)
    {
        if (count($a) < 2) {
            return $a;
        }

        $left = []; //存放比中间值小的数
        $right = [];//存放比中间值大的数

        //设定一个中间值
        $middle = $a[0];

        $i = 1;
        while ($i < count($a)) {
            if ($a[$i] > $middle) {
                $right[] = $a[$i];
            } else {
                $left[] = $a[$i];
            }
            $i++;
        }

        $left = $this->quickSortfun($left);
        $right = $this->quickSortfun($right);

        return array_merge($left, [$middle], $right);
    }

    //斐波那契数列矩阵算法
    public function feibonaqiJuzhen()
    {
        // TODO: Implement feibonaqiJuzhen() method.
        $n = $_GET['n'];
        if ($n == 0) return 0;
        if ($n == 1) return 1;

        $res = [[1, 0], [0, 1]];
        $base = [[1, 1], [1, 0]];

        $start = CommonFun::formatMicrotime();

        while ($n >= 1) {
            if ($n % 2 == 1) {
                $res = $this->feibonaqiJuzhenFun($res, $base);
            }
            $base = $this->feibonaqiJuzhenFun($base, $base);

            $n = $n / 2;
        }

        echo $res[1][1];
        echo "<br>";
        echo CommonFun::formatMicrotime() - $start;
    }

    public function feibonaqiJuzhenFun($res, $baseRes)
    {
        // TODO: Implement feibonaqiFun() method.
        $c = [[0, 0], [0, 0]];
        $c[0][0] = $res[0][0] * $baseRes[0][0] + $res[0][1] * $baseRes[1][0];
        $c[0][1] = $res[0][0] * $baseRes[0][1] + $res[0][1] * $baseRes[1][1];
        $c[1][0] = $res[1][0] * $baseRes[0][0] + $res[1][1] * $baseRes[1][0];
        $c[1][1] = $res[1][0] * $baseRes[0][1] + $res[1][1] * $baseRes[1][1];

        return $c;
    }

    //调用feibonaqiDiguiFun递归算法
    public function feibonaqiDigui()
    {
        $start = CommonFun::formatMicrotime();
        echo $this->feibonaqiDiguiFun($_GET['n']) . "<br>";
        echo CommonFun::formatMicrotime() - $start;

    }

    //斐波那契递归算法
    public function feibonaqiDiguiFun($n)
    {
        if ($n == 0) return 0;
        if ($n == 1) return 1;

        return $this->feibonaqiDiguiFun($n - 1) + $this->feibonaqiDiguiFun($n - 2);
    }

    function sqrt($number = 100)
    {
        $res = $number / 2;
        $y = 0;
        $i = 0;
        while (abs(($res * $res) - $number) > 0.00000001) {
            if (($res * $res) > $number) {
                $res = ($res + $y) / 2;
            } else {
                $res = 2 * $res;
                $y = $res / 2;
            }
            $i++;
        }
        echo $i . "<br>";
        echo $res;
    }
}
