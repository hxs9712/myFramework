<?php
namespace App\Concacts;

interface SortConcact{
    function sort();
    function bubSort();
    function insertSort();
    function mergeSort();
    function mergeSortFun(&$arr, $start, $end);
    function quickSort();
    function quickSortfun($arr);
    function feibonaqiJuzhen();
    function feibonaqiJuzhenFun($res,$base);

}
