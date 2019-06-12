<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goodstype;
use Illuminate\Support\Facades\Cache;

class GoodsTypeController extends Controller
{
    //后台首页
    public function index()
    {
        return view('goodstype.index');
    }

    //商品分类
    public function goodsTypeList()
    {
        $data = Goodstype::all()->toArray();
        $arr = $this->getTree($data);
        return view('goodstype.goodstypelist',['data'=>$arr]);
    }

    //删除
    public function destory(Request $request,$id=null)
    {
        $data = Goodstype::where('f_id',$id)->first();
        if($data){
            return view('success')->with([
                'message'=>'请先删除子分支',
                'url'=>'../goodstype',
                'urlname'=>'商品分类列表',
                'jumpTime'=>3,
            ]);
        }else{
            $data = Goodstype::find($id);
            $data->delete();
            return redirect('goodstype');
        }
    }

    //编辑
    public function edit(Request $request,$id=null)
    {
        //检测缓存文件
        if(Cache::has('type')){
            $type = Cache::get('type');
        }else{
            //从数据库中获取数据  并存入缓存
            $type = Goodstype::all();
            Cache::forever('type',$type);
        }

        //查找数据
        $data = Goodstype::find($id);

        return view('goodstype.edit',['data'=>$data,'type'=>$type]);
    }

    //添加页面
    public function create()
    {
        //检测缓存文件
        if(Cache::has('type')){
            $type = Cache::get('type');
        }else{
            //从数据库中获取数据  并存入缓存
            $type = Goodstype::all();
            Cache::forever('type',$type);
        }

        return view('goodstype.create',['type'=>$type]);
    }

    //添加
    public function createdo(Request $request)
    {
        $res = Goodstype::create($request->input());
        return redirect('goodstype');
    }

    //修改
    public function save(Request $request)
    {
        $data = $request->input();
        Goodstype::updateOrCreate(['id'=>$data['id']],$request->input());
        return redirect('goodstype');
    }


    //递归
    function getTree($data,$pid=0,$level='')
    {
        static $arr = [];
        foreach($data as $k=>$v){
            if($v['f_id'] == $pid){
                $v['type_name'] = $level.$v['type_name'];
                $arr[] = $v;
                $this->getTree($data,$v['id'],$level.'  ');
            }
        }
        return $arr;
    }
}