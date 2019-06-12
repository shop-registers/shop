<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use storage\framework\sessions;

class CommonController extends Controller
{
	public function initialize(Request $request)
      {
      	// $conteoller=Request::instance()->controller(); //控制器
      	// $action=Request::instance()->action();         //方法名
      	// $method=strtolower($action);
      	$user_id=$request->session()->get('user_id');
      	var_dump($user_id);
		// $result='';
		// if($method=='login' || $method=='dengluchuli' || $method=='index'|| $method=='home' || $method=='dir' || $method=='del_article')
  //       {
  //          return;
  //       } 
		if(empty($user_id))
      	{
            $this->error('请先登录','/');die;
      	}
		// if($user_id==11){
		//   $result = true;
		// }else{
		//     $tid=session('tid');
		// 	$list=Db::table('user_role')
		// 		  ->alias('u_r')
		// 		  ->join('role_note r_n','u_r.role_id = r_n.role_id')
		// 		  ->join('note n','r_n.note_id = n.id')
		// 		  ->where('u_r.user_id',$user_id)
		// 		  ->select();

  //     	// print_r($list);
		//  $tid=session('tid');
		// $list_a=Db::table('article')->where('tid',$tid)->select();
		// print_r($list_a); 
  //       $aa=0;
  //       foreach ($list as $key => $value) {
		// 		if($value['action']==$method)
		// 		{
		// 				$aa=1;
		// 		}
  //       }
		
  //       if(!$aa  || empty($list))
  //       {
  //           $this->error('对不起，您没有权限');
  //       }
		// }
      }
	
}