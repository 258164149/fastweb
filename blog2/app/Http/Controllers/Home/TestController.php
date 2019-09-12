<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Controllers\Controller;
use App\Jobs\SendReminderEmail;
class TestController  extends Controller
{

    public function test(){
     for($i=0;$i<1000;$i++)
        $this->dispatch(new SendReminderEmail());
        exit();
    }

}
