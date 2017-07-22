<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class TestController extends Controller
{

    public function index()
    {
        // var_dump(123456);exit();
        return view('admin.article.index');
    }

}
