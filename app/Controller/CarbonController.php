<?php

namespace App\Controller;

use Carbon\Carbon;

class CarbonController extends BaseController
{
    public function test(){
            echo Carbon::now()->subMinutes(2)->diffForHumans();
    }

}
