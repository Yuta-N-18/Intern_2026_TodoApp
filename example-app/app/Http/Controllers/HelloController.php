<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function display_hello(){
        $page_title = "hello page";
        $page_content = "こんにちは";
        return view('hello_page', ['title'=>$page_title, 'content'=>$page_content]);
    }

    public function display_bye(){
        $page_title = "bye page";
        $page_content = "さようなら";
        return view('bye_page', ['title'=>$page_title, 'content'=>$page_content]);
    }
}
