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




    //添加角色
    public function add_roles(Request $request)
    {
        $data = $request->post();
        //查看角色是否已经存在
        $role = $data['role'];
        $add_role_name = DB::table('role')->where('role',$role)->first();
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
        $a = Shop_admin_role::with('role_rbac.rbac')->paginate(5);
//        print_r($a);die;
//        dd($a[0]->role_rbac[1]->rbac->name);
        return view('/role/show_role',['a'=>$a]);
    }
    //修改角色权限
    public function upd_role(Request $request)
    {
        $id = $request->route('id');
        $name = Shop_admin_role::with('role_rbac')->where('id',$id)->get()->toArray();
        $data = Shop_admin_rbac::all()->toArray();
        $res = $this->reat($data,$pid = 0);
        //print_r($data);die;
        //获取角色对应的权限
        $arr = Shop_admin_role_rbac::select('rbac_id')->where('role_id',$id)->get()->toArray();
        foreach ($arr as $item=>$value){
            $a[] = $value['rbac_id'];
        }
        if(isset($a))
        {
            return view('/role/upd_role',['res'=>$res,'name'=>$name,'a'=>$a,'id'=>$id]);
        }
        else
        {
            return view('/role/upd_role',['res'=>$res,'name'=>$name,'id'=>$id]);
        }
    }

    //修改角色
    public function upd_roles(Request $request)
    {
        $data = $request->all();
        $role_id = $data['role_id'];
        if(!isset($data['id']))
        {
            $res = Shop_admin_role_rbac::where('role_id',$role_id)->delete();
            return 1;die;
        }


        $role = Shop_admin_role_rbac::where('role_id',$role_id)->get()->toArray();
//        print_r($role);die;
        if(empty($role))
        {

            $rbac_id = $data['id'];
            $len = count($rbac_id);
            for($i=0; $i<$len; $i++)
            {
                $rbac_ids = $rbac_id[$i];
                $arr = ['role_id'=>$role_id,'rbac_id'=>$rbac_ids];
                $res = Shop_admin_role_rbac::insert($arr);

            }
            if($res)
            {
                return 1;die;
            }
        }


        $rbac_id = $data['id'];
        $len = count($rbac_id);
        $res = Shop_admin_role_rbac::where('role_id',$role_id)->delete();
        if($res)
        {
            for($i=0; $i<$len; $i++)
            {
                $rbac_ids = $rbac_id[$i];
                $arr = ['role_id'=>$role_id,'rbac_id'=>$rbac_ids];
                $res = Shop_admin_role_rbac::insert($arr);

            }
            if($res)
            {
                return 1;die;
            }
        }
        else
        {
            for($i=0; $i<$len; $i++)
            {
                $rbac_ids = $rbac_id[$i];
                $arr = ['role_id'=>$role_id,'rbac_id'=>$rbac_ids];
                $res = Shop_admin_role_rbac::insert($arr);

            }
            if($res)
            {
                return 1;die;
            }
        }

    }


    //删除角色
    public function del_role(Request $request)
    {
        $id = $request->get('id');
        $role_rbac = Shop_admin_role_rbac::where('role_id',$id)->get()->toArray();
        if(!empty($role_rbac))
        {
            return 2;die;
        }
        $res = Shop_admin_role::where('id',$id)->delete();
        if($res)
        {
            return 1;die;
        }

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




}