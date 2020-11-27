<?php

namespace App\Controller;

use App\Classes\CommonFun;
use App\Concacts\AdminConcact;
use App\Model\Admins;
use Xielei\Waf\Waf;

class FirewallController extends BaseController implements AdminConcact
{
    //防火墙
    function wall()
    {
        $waf = new Waf();
        $waf->run();
    }

    function index()
    {
        echo "正常访问";
    }

    /**
     * 管理员列表
     *
     */
    function adminList()
    {
        $list = Admins::query()->get();

        $this->view("Firewall/adminList", ['list' => $list]);
    }
}
