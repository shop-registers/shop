<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class GoodsBrandController extends Controller
{
    //品牌列表
    public function brandlist()
    {
        $page = Input::get('page')?Input::get('page'):1;
        $data = Brand::paginate(15);
        return view('goodsbrand.brandlist',['data'=>$data]);
    }
    //添加页面
    public function brandcreate()
    {
        return view('goodsbrand.brandcreate');
    }

    //添加操作
    public function brandcreatedo(Request $request)
    {
        $data = $request->input();
        $data['brand_logo'] = $request->file('img')->store('img');
        $res = Brand::create($data);
        if($res){
            return view('success')->with([
                'message'=>'添加成功',
                'url'=>'brandcreate',
                'urlname'=>'品牌添加',
                'jumpTime'=>3,
            ]);
        }
    }

    //删除
    public function branddestory(Request $request,$id=null)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect('brandlist');
    }

    //编辑
    public function brandedit(Request $request,$id=null)
    {
        $brand = Brand::find($id);
        return view('goodsbrand.brandedit',['data'=>$brand]);
    }
}
