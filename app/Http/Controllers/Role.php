<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Shop_admin_rbac;
use App\Shop_admin_role;
use Illuminate\Http\Request;

class Role extends Controller
{
    //添加角色
    public function add_role()
    {
        $flight = new Shop_admin_rbac;
        $data =  $flight->all();
//        print_r($data);die;
        $res = $this->reat($data,0);
        return view('/role/add_role',['res'=>$res]);
    }

    public function reat($data,$pid=0)
    {
         $tree = [];
        foreach ($data as $key => $v)
        {
            if($v['pid'] == $pid)
            {
                $v['son'] = $this->reat($data,$v['id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }

    public function add_roles(Request $request)
    {
        $data = $request->post();
//        $id = $data['id'];
        $role = $data['role'];
        $res = new Shop_admin_role;
        $data =  $res->insert(['role',$role]);
        print_r($data);
    }



    //列表展示角色
    public function show_role()
    {
        return view('/role/show_role');
    }

}