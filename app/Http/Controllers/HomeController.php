<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // hàm index của HomeController để trả về view index ngoài
    public function index()
    {
        return view('index');
    }
}
