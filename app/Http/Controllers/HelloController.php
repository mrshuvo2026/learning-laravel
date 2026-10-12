<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function hello()
    {
        $name = "Mehedi";
     return view('hello',compact('name'));
    }

}

