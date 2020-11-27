<?php
namespace App\Controller;

use App\Classes\ErrCode;

class BaseController
{
    public function response($code,$msg,$data,$total)
    {
        $result = [
          'code'=>$code,
          'msg'=>$msg,
          'total'=>$total,
          'data'=>$data
        ];
        header('Content-Type:application/json; charset=utf-8');

        echo json_encode($result);
    }

    /**
     * 成功返回结果
     * @param $data
     * @param int $total
     * @return false|string
     */
    public function success($data,$total=0)
    {
         $this->response(ErrCode::$Success,ErrCode::CodeToMsg(ErrCode::$Success),$data,$total);
    }

    /**
     * 失败返回结果
     * @param $code
     * @param bool $msg
     * @param array $data
     * @param int $total
     * @return false|string
     */
    public function fail($code,$msg = false,$data=[],$total=0){
         $this->response(ErrCode::$Success,$msg?$msg:ErrCode::CodeToMsg(ErrCode::$Success),$data,$total);
    }

    public function view($viewName,$data=[]){
        foreach ($data as $key=>$v){
            $$key = $v;
        }
      include dirname(__FILE__,2).'/View/'.$viewName.'.php';
    }
}
