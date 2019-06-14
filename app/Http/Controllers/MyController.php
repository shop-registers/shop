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
    //验证滑动token
    // public function check_token(Request $request)
    // {
    //     $token=$request->input('token');
        
    //     require PATHNAME.'\\php\\CaptchaClient.php';
    //     return $token;
    //     /**构造入参为appId和appSecret
    //      * appId和前端验证码的appId保持一致，appId可公开
    //      * appSecret为秘钥，请勿公开
    //      * token在前端完成验证后可以获取到，随业务请求发送到后台，token有效期为两分钟**/
    //     $appId = "46bd7c134151feb0265fd1ba9e2f5b7c";
    //     $appSecret = "dce66af8d9ed36f86828dc55c4489d1d";
    //     $client = new CaptchaClient($appId,$appSecret);
    //     $client->setTimeOut(2);      //设置超时时间，默认2秒
    //     # $client->setCaptchaUrl("http://cap.dingxiang-inc.com/api/tokenVerify");   
    //     //特殊情况可以额外指定服务器，默认情况下不需要设置
    //     $response = $client->verifyToken($token);
    //     // echo $response->serverStatus;
    //     //确保验证状态是SERVER_SUCCESS，SDK中有容错机制，在网络出现异常的情况会返回通过
    //     if($response->result){
    //         return 1;
    //         /**token验证通过，继续其他流程**/
    //     }else{
    //         return 0;
    //         /**token验证失败**/
    //     }
    // }
    public function login_do(Request $request)
    {
        $name=$request->input('name');
        $password=$request->input('pwd');
        $last_time=time();
        //根本获取的数据去数据库中查询
        $res = Users::where(['name'=>$name,'password'=>$password])->first();
        //如果有就代表账号密码正确,写入session
        if ($res){
            $request->session()->put('name',$name);
            $request->session()->put('user_id',$res['id']);
            $user_id=$res['id'];
            //修改登录最后时间字段
            if(Users::where(['id'=>$user_id])->update(['last_time'=>$last_time]))
            {
                return 1;//登录成功
            }elsE{
                return 2; //修改失败
            }          
        }
        return $res;//登录失败

    }
    //重置密码
    public function reset_password()
    {
        echo "258";
    }
	// 后台首页
    public function index(Request $request)
    {
        $user_name=$request->session()->get('name');  //用户名
        $user_id=$request->session()->get('user_id'); //用户id
        $time=time(); 
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
        // var_dump($menu_data3);
        //渲染视图层
    	return view("index",['user_name'=>$user_name,'time'=>$time,'user_id'=>$user_id,'menu_data3'=>$menu_data3]);
    }
    public function index_v1()
    {
    	return view("index_v1");
    }

    ////递归方法
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
