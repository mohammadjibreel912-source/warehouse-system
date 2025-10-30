<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admim.index'); // يجب أن تنشئ Blade dashboard هنا
    }
}
