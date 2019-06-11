<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Good_attr;
use App\Models\Goods;

class GoodsController extends Controller
{
    //
    public function Attr_list(){
    	$type = DB::table('good_attr')->paginate(10);
    	return view('attr/list',['info'=>$type]);
    }
    public function Attr_add(Request $request){
    	$data=$request->input();
    	unset($data['_token']);
    	$res=DB::table('good_attr')->insert($data);
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'你已经提交信息，请您耐心等待！',
                //自己的跳转路径
                'url' =>'attr_list',
                //跳转路径名称
                'urlname' =>'属性列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    public function updata_once(Request $request){
    	$data=$request->input();
    	$res=DB::table('good_attr')->where('id', $data['f_id'])->update(['attr_desc' => $data['attr_desc']]);
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'修改成功',
                //自己的跳转路径
                'url' =>'/attr/attr_list',
                //跳转路径名称
                'urlname' =>'属性列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    public function Attr_delete(Request $request){
    	$id=$request->input('id');
    	$res=DB::table('good_attr')->where('id', '=',$id)->delete();
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'删除成功，正在跳转回上一页面！',
                //自己的跳转路径
                'url' =>'attr_list',
                //跳转路径名称
                'urlname' =>'属性列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    public function Attr_updata(Request $request){
    	$data=$request->input();
    	$res=DB::table('good_attr')->where('id', $data['f_id'])->update(['attr_desc' => $data['attr_desc']]);
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'你已经提交信息，请您耐心等待！',
                //自己的跳转路径
                'url' =>'attr_list',
                //跳转路径名称
                'urlname' =>'属性列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    public function Good_list(){
    	$res=DB::table('goods')->get();
    	return view('goods/list',['goodsinfo'=>$res]);
    }
    public function Good_add(Request $request){
    	$data=$request->input();

    	//商品主图上传
    	$file = $request->file('good_img');//获取图片
        $theme = $request->theme;//主题
        $status = $request->status;//状态
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return response()->json([
                'status' => false,
                'message' => '只能上传 png | jpg | gif格式的图片'
            ]);
        }
        $destinationPath = 'uploads/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $data['good_img']=$fileName;
    	
    }
    public function Good_delete(){

    }
    public function Good_updata(){

    }
    public function Change_attr(Request $request){
    	$id=$request->input('id');
    	$res=Good_attr::where('type_id',$id)->get();
    	echo json_encode($res);
    }
    /**
   	 * 笛卡尔积算法
     * 一键生成sku属性
     */
    public function CartesianProduct(Request $request){
    	$id=$request->input('id');
    	$arr=Good_attr::where('type_id',$id)->get();
    	$sets=[];
    	foreach ($arr as $k=>$v) {
		    $sets[$k]=explode(',',$v->attr_desc);
		}
	    // 保存结果
	    $result = array();
	    // 循环遍历集合数据
	    for($i=0,$count=count($sets); $i<$count-1; $i++){
	        // 初始化
	        if($i==0){
	            $result = $sets[$i];
	        }
	        // 保存临时数据
	        $tmp = array();
	        // 结果与下一个集合计算笛卡尔积
	        foreach($result as $res){
	            foreach($sets[$i+1] as $set){
	                $tmp[] = $res.','.$set;
	            }
	        }
	        // 将笛卡尔积写入结果
	        $result = $tmp;
	    }
	   	echo json_encode($result);
	}
}
