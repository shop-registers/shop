<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class GoodsBrandController extends Controller
{
    //品牌列表
    public function brandlist()
    {
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
                'url'=>'../brandcreate',
                'urlname'=>'品牌添加',
                'jumpTime'=>2,
            ]);
        }

    }
}
