<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rbac;

class MenuController extends Controller
{
	public function add_menu(Request $request)
	{
		if($request->post())
		{
             echo "我是菜单添加";
		}
        $data=Rbac::all();
        // var_dump($data);
		return view("add_menu");
	}

	public function menu_list()
	{
		echo "456789";
	}
}