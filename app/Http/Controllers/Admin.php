<?php


namespace App\Http\Controllers;
use App\Shop_admin_users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;


class Admin extends Controller
{
    //添加角色
    public function add_admin()
    {
        return view('/admin/add_admin');
    }
    //添加表单
    public function haha(Request $request)
    {
            $data = $request->all();
            unset($data['_token']);
        $rules=[
            'name'=>'unique:shop_admin_users,name|required|alpha_dash|between:2,30',
            'pwd'=>'required|between:8,10',
            'email'=>'unique:shop_admin_users,email|required|email',
            'tel'=>'required|digits:11',
            'real_name'=>'required|alpha_dash|between:2,4',
        ];
        $message=[
            'name.min'=>'name',
            'name.required'=>'name',
            'name.alpha_dash'=>'name',
            'name.unique'=>'names',
            'pwd.required'=>'pwd',
            'pwd.between'=>'pwd',
            'email.required'=>'email',
            'email.email'=>'email',
            'email.unique'=>'emails',
            'tel.required'=>'tel',
            'tel.digits'=>'tel',
            'real_name.required'=>'real_name',
            'real_name.alpha_dash'=>'real_name',
            'real_name.between'=>'real_name',
        ];
        $validator=Validator::make($data,$rules,$message);
        if(!$validator->passes()){
            $validatorErrs = $validator->errors()->all();
            $errMessages=['errcode'=>1, 'msg'=>$validatorErrs];
            return  json_encode($errMessages,JSON_UNESCAPED_UNICODE);
        }
        $data['last_time']=time();
          $add_user = new Shop_admin_users;
          $res = $add_user->insert($data);
          if($res)
          {
              return 1;
          }
    }


    //列表展示角色
    public function show_admin()
    {
        $add_user = new Shop_admin_users;
        $res = $add_user->all();
        return view('/admin/show_admin',['res'=>$res]);
    }

    //修改信息
    public function upd_admin(Request $request)
    {
        $id = $request->route('id');
        $add_user = new Shop_admin_users;
        $res = $add_user->where('id',$id)->first();
        return view('/admin/upd_admin',['res'=>$res]);
    }

    //修改
    public function upd(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $rules=[
            'name'=>'unique:shop_admin_users,name|required|alpha_dash|between:2,30',
            'pwd'=>'required|between:8,10',
            'email'=>'unique:shop_admin_users,email|required|email',
            'tel'=>'required|digits:11',
            'real_name'=>'required|alpha_dash|between:2,4',
        ];
        $message=[
            'name.min'=>'name',
            'name.required'=>'name',
            'name.alpha_dash'=>'name',
            'name.unique'=>'names',
            'pwd.required'=>'pwd',
            'pwd.between'=>'pwd',
            'email.required'=>'email',
            'email.email'=>'email',
            'email.unique'=>'emails',
            'tel.required'=>'tel',
            'tel.digits'=>'tel',
            'real_name.required'=>'real_name',
            'real_name.alpha_dash'=>'real_name',
            'real_name.between'=>'real_name',
        ];
        $validator=Validator::make($data,$rules,$message);
        if(!$validator->passes()){
            $validatorErrs = $validator->errors()->all();
            $errMessages=['errcode'=>1, 'msg'=>$validatorErrs];
            return  json_encode($errMessages,JSON_UNESCAPED_UNICODE);
        }
        $data['last_time']=time();
        print_r($data);
    }


}