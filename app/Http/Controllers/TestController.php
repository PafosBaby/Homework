<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testPage()
    {
        echo 'hello from test TestController!';
    }

    public function productpage()
    {
        echo 'Hello';
    }

    public function templatePage()
    {
        return view('templates.my-template');
    }
}
