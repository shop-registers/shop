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
    public function fileget(Request $request){
    	$file = $request->file('file');
  		dd($file);
    	//判断请求中是否包含name=file的上传文件
	    if(!$request->hasFile('file')){
	        exit('上传文件为空！');
	    }
	    $file = $request->file('file');
    	var_dump($file);die;
    }
}
