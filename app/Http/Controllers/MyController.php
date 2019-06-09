<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //
    public function index(){
    	return view('admin/index');
    }
    public function index_v1(){
    	return view('admin/index_v1');
    }
}
