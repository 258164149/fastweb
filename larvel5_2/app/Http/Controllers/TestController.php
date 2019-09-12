<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;


class TestController extends Controller
{
    public function __construct()
    {
        
    }
    //
    public function index(){
        $user = Auth::user()->id;
        print_r($user);

    }
}
