<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Good_attr;
use App\Models\Goods;
use App\Models\Admin_brand;
use App\Models\Goods_img;
use App\Models\Goods_sku;

class GoodsController extends Controller
{
    /**
     * 属性列表
     */
    public function Attr_list(){
    	$type = DB::table('good_attr')->paginate(10);
    	return view('attr/list',['info'=>$type]);
    }
    /**
     * 属性添加入库
     */
    public function Attr_add(Request $request){
        if($request->isMethod('get')){
            $type = DB::table('admin_goodstype')->get()->toArray();
            $res=$this->getTree($type);
            return view('attr/add',['type'=>$res]);
        }else{
            $data=$request->input();
            unset($data['_token']);
            $res=DB::table('good_attr')->insert($data);
            if($res){
                return view('success')->with([
                    //跳转信息
                    'message'=>'你已经提交信息，请您耐心等待！',
                    //自己的跳转路径
                    'url' =>'../attr/list',
                    //跳转路径名称
                    'urlname' =>'属性列表',
                    //跳转等待时间（s）
                    'jumpTime'=>3,
                ]);
            }    
        }
    }
    /**
     * 添加某一个属性的属性值
     */
    public function updata_once(Request $request){
    	$data=$request->input();
    	$res=DB::table('good_attr')->where('id', $data['id'])->update(['attr_desc' => $data['attr_desc']]);
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'修改成功',
                //自己的跳转路径
                'url' =>'../attr/list',
                //跳转路径名称
                'urlname' =>'属性列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    /**
     * 属性的删除
     */
    public function Attr_delete(Request $request){
    	$id=$request->input('id');
    	$res=DB::table('good_attr')->where('id', '=',$id)->delete();
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'删除成功，正在跳转回上一页面！',
                //自己的跳转路径
                'url' =>'../attr/list',
                //跳转路径名称
                'urlname' =>'属性列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    /**
     * 
     */
    public function Attr_updata(Request $request){
    	$data=$request->input();
    	$res=DB::table('good_attr')->where('id', $data['f_id'])->update(['attr_desc' => $data['attr_desc']]);
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'你已经提交信息，请您耐心等待！',
                //自己的跳转路径
                'url' =>'../attr/list',
                //跳转路径名称
                'urlname' =>'属性列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    /**
     * 商品列表
     */
    public function Good_list(){
    	$res=Goods::paginate(10);
    	return view('goods/list',['goodsinfo'=>$res]);
    }
    /**
     * 商品添加入库与商品主图上传
     */
    public function Good_add(Request $request){
        if($request->isMethod('get')){
            $type = DB::table('admin_goodstype')->get()->toArray();
            $brand = Admin_brand::get();
            $res=$this->getTree($type);
            return view('goods/add',['type'=>$res,'brand'=>$brand]);    
        }else{
            $data=$request->input();
            unset($data['_token']);
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
            if($fileName){
                $data['good_img']=$fileName;
                $data['good_addtime']=time();
                $res=Goods::insert($data);
                if($res){
                    return view('success')->with([
                        //跳转信息
                        'message'=>'你已经提交信息，请您耐心等待！',
                        //自己的跳转路径
                        'url' =>'../goods/list',
                        //跳转路径名称
                        'urlname' =>'属性列表',
                        //跳转等待时间（s）
                        'jumpTime'=>3,
                    ]);
                }   
            }    
        }

    }
    /**
     * 删除商品
     */
    public function Good_delete(Request $request){
		$id=$request->input('id');
        $res=DB::transaction(function () {
            Goods::where('id', '=',$id)->delete();
            Good_attr::where('good_id','=',$id)->delete();
            Goods_img::where('good_id','=',$id)->delete();
        });
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'删除成功，正在跳转回上一页面！',
                //自己的跳转路径
                'url' =>'../goods/list',
                //跳转路径名称
                'urlname' =>'属性列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    /**
     * 修改商品
     */
    public function Good_updata(Request $request){
        if($request->isMethod('get')){
            $id=$request->input('id');
            $type= DB::table('admin_goodstype')->get()->toArray();
            $res=$this->getTree($type);
            $info=DB::table('goods')->where('id',$id)->get();
            $brand=Admin_brand::get();
            return view('goods/updata_goodinfo',['goodinfo'=>$info[0],'type'=>$res,'brand'=>$brand]);
        }else{
            $data=$request->input();
            unset($data['_token']);
            $res=Goods::where('id', $data['f_id'])->update($data);
            if($res){
                return view('success')->with([
                    //跳转信息
                    'message'=>'修改成功',
                    //自己的跳转路径
                    'url' =>'../goods/list',
                    //跳转路径名称
                    'urlname' =>'属性列表',
                    //跳转等待时间（s）
                    'jumpTime'=>3,
                ]);
            }
        }
    }

    /**
     * 商品图片(主图与所有副图展示)
     */
    public function Good_imglist(){
    	$res=Goods::select('Goods.id','good_name','good_img')->paginate(10);
    	foreach ($res->items() as &$value) {
    		# code...
    		$value['img_src']=Goods_img::where('goods_id',$value['id'])->select('img_src')->get();
    	}
    	return view('goods/imglist',['goodsinfo'=>$res]);
    }
    /**
     * ajax改变时查询出对应的属性值
     */
    public function Change_attr(Request $request){
    	$id=$request->input('id');
    	$res=Good_attr::where('good_id',$id)->get();
    	echo json_encode($res);
    }
    /**
     * ajax改变时查询出对应的商品
     */
    public function Change_good(Request $request){
        $id=$request->input('id');
        $res=Goods::where('type_id',$id)->get();
        echo json_encode($res);
    }
    /**
     * ajax改变时查询出相对应的品牌
     */
    public function Change_brand(Request $request){
    	$id=$request->input('type_id');
    	$res=Admin_brand::where('type_id',$id)->get();
    	echo json_encode($res);
    }
    /**
     * 生成sku的编码
     * @goods_id 商品的ID
     * @type_id 分类的ID
     * @goods_addtime 商品的添加时间
     */
    public function sku_code($goods_id,$type_id){
    	$str=date('yz',time()).$goods_id.$type_id;
    	return $str;
    }

    public function data_change($data){
        $good_id=$data['good_id'];
        $type_id=$data['type_id'];
        $price=$data['price'];
        //判断是否有中文的键
        foreach ($data as $key => $value) {
            if(preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $key) === 1){
                unset($data[$key]);
            }elseif(preg_match('/[\x{4e00}-\x{9fa5}]/u', $key) === 1){
                unset($data[$key]);
            }
        }
        unset($data['_token']);
        unset($data['price']);
        unset($data['good_id']);
        unset($data['type_id']);
        $inventory=$data['inventory'];
        unset($data['inventory']);
        unset($data['limit_id']);
        $arr=[];
        foreach ($data as $key => $value) {
            $arr[$key]['sku_id']=$this->sku_code($good_id,$type_id);
            $arr[$key]['price']=$price[$key];
            $arr[$key]['inventory']=$inventory[$key];
            $arr[$key]['sku_desc']=implode(',',$value);
            $arr[$key]['goods_id']=$good_id;
        }
        return $arr;
    }

    public function sku_fill($data){
        //判断是否有中文的键
        foreach ($data as $key => $value) {
            if(preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $key) === 1){
                unset($data[$key]);
            }elseif(preg_match('/[\x{4e00}-\x{9fa5}]/u', $key) === 1){
                unset($data[$key]);
            }
        }
        unset($data['_token']);
        unset($data['price']);
        $good_id=$data['good_id'];
        unset($data['good_id']);
        unset($data['type_id']);
        unset($data['inventory']);
        unset($data['limit_id']);
        $arr=[];
        foreach ($data as $key => $value) {
            $arr['sku_desc'][]=implode(',',$value);
        }
        $info=Goods_sku::where('goods_id',$good_id)->select('sku_desc')->get()->toArray();
        $res=in_array($arr['sku_desc'],$info);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
   	 * 笛卡尔积算法
     * 一键生成sku属性
     */
    public function CartesianProduct(Request $request){
    	$id=$request->input('id');
    	$arr=Good_attr::where('good_id',$id)->get();
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
    /**
     * ajax上传副图
     */
	public function multiUploadImg(Request $request){
       $id = $request->input('goods_id');//获取图片
       $file = $request->file('file');//获取图片
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
        $data['img_src']=$fileName;
        $data['goods_id']=$id;
        $res=Goods_img::insertGetId($data);
        echo json_encode($fileName);
    }
    /**
     * 删除副图
     */
    public function delete_img(Request $request,$goods_id,$id){
    	$info=Goods_img::where('id',$id)->get();
    	foreach ($info as $key => $value) {
    		# code...
    		Storage::delete('uploads/'.$value['img_src']);
    	}
    	
    	$res=Goods_img::where('id', '=',$id)->delete();
    	if($res){
    		return view('success')->with([
   				//跳转信息
                'message'=>'删除成功，正在跳转回上一页面！',
                //自己的跳转路径
                'url' =>'../../auxiliary_img/'.$goods_id,
                //跳转路径名称
                'urlname' =>'图片列表',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
    	}
    }
    public function getTree($data,$pid=0,$level=1)
    {
        static $arr = [];
        foreach($data as $k=>$v){
            if($v->f_id == $pid){
                $v->type_name = $level.$v->type_name;
                $arr[] = $v;
                $this->getTree($data,$v->id,$level+1 );
            }
        }
        return $arr;
    }
    public function Show_sku(Request $request){
        if($request->isMethod('get')){
            $type = DB::table('admin_goodstype')->get()->toArray();
            $res=$this->getTree($type);
            return view('goods/addsku',['type'=>$res]);
        }else{
            $data=$request->input();
            $true=$this->sku_fill($data);
            if($true==1){
                return view('success')->with([
                    //跳转信息
                    'message'=>'已经存在相同的数据',
                    //自己的跳转路径
                    'url' =>'../goods/addsku',
                    //跳转路径名称
                    'urlname' =>'生成sku',
                    //跳转等待时间（s）
                    'jumpTime'=>3,
                ]);
            }else{
                $arr=$this->data_change($data);
                $res=Goods_sku::insert($arr);
                if($res){
                    return view('success')->with([
                        //跳转信息
                        'message'=>'修改成功',
                        //自己的跳转路径
                        'url' =>'../goods/addsku',
                        //跳转路径名称
                        'urlname' =>'属性列表',
                        //跳转等待时间（s）
                        'jumpTime'=>3,
                    ]);
                }    
            }
        }
    }
}

