<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function message(){
        $msg = 'Hello';
        $title = "Title - 20260206";
        return view('child', ['hello'=>$msg, 'title'=>$title]);
    }
}
