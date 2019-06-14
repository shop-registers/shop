<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\shop;
use App\Models\Add;
use DB;

class WarehouseController extends Controller
{
    //仓库添加
    public function WarehouseAdd(Request $request)
    {

        $data = Add::where('p_id',0)->select('id','p_id','area_name')->get()->toArray();

        // return view('orderlist.orderAdd',['data'=>$data]);
    	return view('warehouse.WarehouseAdd',['data'=>$data]);
    }

    public function WarehouseAdds(Request $request)
    {
    	$data = $request->post();
    	// print_r($data);die;
    	$res = Warehouse::insert($data);
    	if($res)
    	{
    		echo 1;die;
    	}
    	else
    	{
    		echo 2;die;
    	}

}
    //仓库列表
    public function WarehouseShow()
    {

    }
}
