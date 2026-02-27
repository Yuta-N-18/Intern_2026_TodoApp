<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function display_home(){
        $page_title = "home page";
        $page_content = "ようこそ";
        return view('welcome', ['title'=>$page_title, 'content'=>$page_content]);
    }

    public function move_tasks(){
        return redirect()->route('task.showall');
    }
}
