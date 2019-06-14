<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rbac;

class MenuController extends Controller
{
	//添加菜单
	public function add_menu(Request $request)
	{
		if($request->Post())
		{
             $data=$request->input();
             unset($data['_token']);
             if(Rbac::insertGetId($data))
             {
             	return redirect("menu_list");
             }
		}
        $data=Rbac::where(['is_show'=>'0'])->get()->toArray();
        // var_dump($data);die;
		return view("add_menu",['data'=>$data]);
	}
    
    //菜单列表
	public function menu_list()
	{
		$data=Rbac::get()->toArray();
		return view("menu_list",['data'=>$data]);
	}

	//zi菜单列表
	public function submenu_list(Request $request)
	{
		$id=$request->input('id');
		$data=Rbac::where('pid',$id)->get()->toArray();
		if(empty($data))
		{
           return 0;
		}else{
			return json_encode($data);
		}
	}

	//删除菜单---mysql事务处理
	public function del_menu(Request $request)
	{
		$id=$request->input("id");
		$user_id=$request->session()->get('user_id');
		$res=Rbac::where("pid",$id)->get()->toArray();
		if(empty($res))
		{
           DB::beginTransaction(); 
           try { 
           	       $res1 = DB::table('rbac')->where('id',$id)->delete();   //删除权限表
           	       $res2 = DB::table('role_rbac')->where("role_id",$user_id)->where("rbac_id",$id)->delete();           //删除角色-权限关系表
           	       if($res1&&$res2){ 
           	       	     DB::commit(); 
           	       	     return 1;  //删除成功 
           	       	 } 
           	     } 
           	catch (\Exception $e) 
           	    { 
           	    	DB::rollBack(); 
           	    	return 0;  //删除失败 
           	    }
		  
		}else{
			return 2;//该菜单还有子菜单不能进行删除
		}
	}

	//编辑菜单
	public function update_menu(Request $request)
	{
        $id=$request->input("id");
        $data=Rbac::where("pid",$id)->get()->toArray();
        if(empty($data))
        {
        	//进行菜单编辑
        	return 1;
        }else{
        	
        	return 2;//存在子菜单，编辑失败
        }
        
		// return view("update_menu");
	}
	public function update_menu1(Request $request)
	{
		$id=$request->input("id");
        $data=Rbac::where("id",$id)->first()->toArray();
        // var_dump($data);die;
		return view('update_menu1',['data'=>$data]);
	}
	public function update_menu2(Request $request)
	{
       $data=$request->input();
       unset($data['_token']);
       $res=Rbac::where('id',$data['id'])->update($data);
       if($res)
       {
       	  //编辑成功  跳转展示
          return redirect("menu_list");
       }

	}
}