<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Shop_admin_rbac;
use App\Shop_admin_role;
use App\Shop_admin_role_rbac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    //无限极分类
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

    //添加角色
    public function add_roles(Request $request)
    {
        $data = $request->post();
        //查看角色是否已经存在
        $role = $data['role'];
        $add_role_name = DB::table('shop_admin_role')->where('role',$role)->first();
        if(!empty($add_role_name))
        {
            return 3;
        }
        $res = new Shop_admin_role;
        $add_id =  $res->insertGetId(['role'=>$role]);

        if(isset($data['id']))
        {
                $id = $data['id'];
                $ids = count($id);
                if(empty($add_id))
                {
                    return 2;
                }
                if($add_id)
                {
                    for($i=0; $i<$ids; $i++)
                    {
                        $rbac_id = $id[$i];
                        $role_rbac = new Shop_admin_role_rbac;
                        $add_role_rbac =  $role_rbac->insert(['role_id'=>$add_id,'rbac_id'=>$rbac_id]);
                    }
                    return 1;die;
                }
        }
        return 1;die;

    }



    //列表展示角色
    public function show_role()
    {

        $a = Shop_admin_role::with('role_rbac.rbac')->get()->toArray();
//        print_r($a);die;
//        $role_rbac = Shop_admin_role::leftjoin('shop_admin_role_rbac','shop_admin_role.id','=','shop_admin_role_rbac.role_id')->get()->toArray();
//        $role_rbac = Shop_admin_role::get()->toArray();
//        foreach ($role_rbac as $key => $val)
//        {
//
////            print_r($arr);die;
//            $role_id = $val['id'];
//            $role_rbac = Shop_admin_role_rbac::where('role_id',$role_id)
//            ->get()->toArray();
//            foreach ($role_rbac as $key2 =>$val2)
//            {
//                $rbac_id = $val2['rbac_id'];
//                $res = Shop_admin_rbac::where('id',$rbac_id)
//                    ->get()->toArray();
//                $arrs[] = $res['0']['name'];
////                print_r($arrs);die;
//            }
//            $arr[] = $role_rbac[$key];
//            $arr[] = $arrs;
//            $a = array_merge($arr,$arrs);
//
//        }
//        print_r($arr);die;


        return view('/role/show_role',['a'=>$a]);
    }

    public function upd_role()
    {
        echo 2;die;
    }


}