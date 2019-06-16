<?php


namespace App\Http\Controllers;
use App\Shop_admin_role;
use App\Shop_admin_users;
use App\Shop_admin_user_role;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Input;


class Admin extends Controller
{
    //添加角色
    public function add_admin()
    {
        $data = Shop_admin_role::all();
        return view('/admin/add_admin',['data'=>$data]);
    }
    //添加表单
    public function haha(Request $request)
    {
            $data = $request->all();
            unset($data['_token']);
        $rules=[
            'name'=>'unique:shop_admin_users,name|required|alpha_dash|between:2,30',
            'password'=>'required|between:8,10',
            'email'=>'unique:shop_admin_users,email|required|email',
            'tel'=>'required|digits:11'
        ];
        $message=[
            'name.min'=>'name',
            'name.required'=>'name',
            'name.alpha_dash'=>'name',
            'name.unique'=>'names',
            'password.required'=>'password',
            'password.between'=>'password',
            'email.required'=>'email',
            'email.email'=>'email',
            'email.unique'=>'emails',
            'tel.required'=>'tel',
            'tel.digits'=>'tel',
        ];
        $validator=Validator::make($data,$rules,$message);
        if(!$validator->passes()){
            $validatorErrs = $validator->errors()->all();
            $errMessages=['errcode'=>1, 'msg'=>$validatorErrs];
            return  json_encode($errMessages,JSON_UNESCAPED_UNICODE);
        }
        $arr['last_time']=time();
        $arr['name'] = $data['name'];
        $arr['password'] = $data['password'];
        $arr['email'] = $data['email'];
        $arr['tel'] = $data['tel'];
        $role_id = $data['r_id'];
//        print_r($data);die;
        $add_user = Shop_admin_users::insertGetId($arr);
        if($add_user)
        {
             $res = Shop_admin_user_role::insert(['r_id'=>$role_id,'u_id'=>$add_user]);
             if($res)
             {
                 return 1;die;
             }

        }


    }

    //列表展示角色
    public function show_admin()
    {
//        $page = Input::get('page')?Input::get('page'):1;
//        $minutes = 120;
//        $res = Cache::remember('brand'.$page,$minutes,function(){
            $res = Shop_admin_users::paginate(3);
//        });
        foreach($res as $key => $val)
        {
            $res[$key]['time'] = date('Y-m-d H:i:s',$val['last_time']);
        }
        return view('/admin/show_admin',['res'=>$res]);
    }

    //修改信息
    public function upd_admin(Request $request)
    {

        $id = $request->route('id');
        //用户表
        $add_user = new Shop_admin_users;
        $res = $add_user->where('id',$id)->first();
        $data = DB::table('role')->get()->toArray();
        return view('/admin/upd_admin',['res'=>$res,'data'=>$data]);
    }

    public function admin_del(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->get('id');
            $data = DB::table('users')->where('id',$id)->delete();
            $aa = DB::table('user_role')->where('u_id',$id)->get();
            if(!empty($aa))
            {
                $res = DB::table('user_role')->where('u_id',$id)->delete();
                if($res)
                {
                    return 1;die;
                }
            }

            return 1;die;






        }
    }


    //修改
    public function upd(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $rules=[
            'name'=>'required|alpha_dash|between:2,30',
            'pwd'=>'required|between:8,30',
            'email'=>'required|email',
            'tel'=>'required|digits:11',
        ];
        $message=[
            'name.min'=>'name',
            'name.required'=>'name',
            'name.alpha_dash'=>'name',
//            'name.unique'=>'names',
            'pwd.required'=>'pwd',
            'pwd.between'=>'pwd',
            'email.required'=>'email',
            'email.email'=>'email',
//            'email.unique'=>'emails',
            'tel.required'=>'tel',
            'tel.digits'=>'tel',
        ];
        $validator=Validator::make($data,$rules,$message);
        if(!$validator->passes()){
            $validatorErrs = $validator->errors()->all();
            $errMessages=['errcode'=>1, 'msg'=>$validatorErrs];
            return  json_encode($errMessages,JSON_UNESCAPED_UNICODE);
        }
        $data['last_time']=time();
        $name = $data['name'];
        $pwd = $data['pwd'];
        $email = $data['email'];
        $tel = $data['tel'];
        $last_time = $data['last_time'];
        $u_id = $data['u_id'];
        $r_id = $data['r_id'];
        $res = DB::table('users')->where('id',$data['u_id'])->update(['name'=>$name,'password'=>$pwd,'email'=>$email,'tel'=>$tel,'last_time'=>$last_time]);
        if($res)
        {
            $code = DB::table('user_role')->where('u_id',$u_id)->first();
            if(empty($code))
            {
                $user_role = DB::table('user_role')->insert(['u_id'=>$u_id,'r_id'=>$r_id]);
                return 1;die;
            }
            $user_role = DB::table('user_role')->where('u_id',$u_id)->update(['r_id'=>$r_id]);
            return 1;die;


        }

    }


}