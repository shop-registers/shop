<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Http\Controllers\Controller;

class MyController extends Controller
{
	// 登录
	public function login()
	{
		return view("login");
	}
    public function login_do(Request $request)
    {
        $name=$request->input('name');
        $password=$request->input('password');
        //根本获取的数据去数据库中查询
        $res = Users::where(['name'=>$name,'password'=>$password])->first();
        //如果有就代表账号密码正确,写入session
        if ($res->count()){
            $request->session()->put('name',$name);
            $request->session()->put('user_id',$res['id']);
            return redirect('index')->with('tip', '登录成功');;
        }


    }
	// 后台首页
    public function index(Request $request)
    {
        $user_name=$request->session()->get('name');  //用户名
        $user_id=$request->session()->get('user_id'); //用户id
        // 多表联查菜单数据
        $menu_data = DB::table('users')
            ->join('user_role', 'users.id', '=', 'user_role.u_id')
            ->join('role_rbac', 'user_role.r_id', '=', 'role_rbac.role_id')
            ->join('rbac', 'role_rbac.rbac_id', '=', 'rbac.id')
            ->where('users.id','=',$user_id)
            ->where('rbac.is_show','=','0')
            ->get();
        $menu_data2=json_decode($menu_data, true);
        // var_dump($menu_data2);
        //调用递归
        $menu_data3=$this->getTree($menu_data2,0);
        // var_dump($res);
        //渲染视图层
    	return view("index",['user_name'=>$user_name,'user_id'=>$user_id,'menu_data3'=>$menu_data3]);
    }
    public function index_v1()
    {
    	return view("index_v1");
    }

    ////递归方法
    // function getTree($menu_data2, $pid)
    // {
    //     $tree = '';
    //     foreach($menu_data2 as $k => $v)
    //     {
    //         if($v['pid'] == $pid)
    //         {         //父亲找到儿子
    //             $v['pid'] =$this->getTree($menu_data2, $v['id']);
    //             $tree[] = $v;
    //             unset($menu_data2[$k]);
    //         }
    //     }
    //     return $tree;
    // }
     function getTree($menu_data2,$pid)
    {
        //初始化儿子 
        $child = []; 
        //循环所有数据找$id的儿子 
        foreach ($menu_data2 as $key => $datum) 
        { 
        //找到儿子了 
        if ($datum['pid'] == $pid) 
        { //保存下来，然后继续找儿子的儿子 
        $child[$datum['id']] = $datum; //先去掉自己，自己不可能是自己的儿孙 
        unset($menu_data2[$key]); //递归找，并把找到的儿子放到一个child的字段中 
        $child[$datum['id']]['child'] = $this->getTree($menu_data2, $datum['id']); } } 
      return $child;
     }
}
