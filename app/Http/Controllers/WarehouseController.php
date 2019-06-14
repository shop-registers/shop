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
        $data = Warehouse::paginate(5);
    	return view('warehouse.WarehouseShow',['data'=>$data]);
    }
    //仓库删除
    public function WarehouseDel(Request $request)
    {
        $warehouse_id = $request['id'];
        $info = warehouse::where('warehouse_id',$warehouse_id)->delete();
        if($info)
        {
            echo "<script>alert('删除成功');location.href='WarehouseShow'</script>";
        }
        else
        {
            echo "<script>alert('删除失败');location.href='WarehouseShow'</script>";
        }
    }
    //仓库修改
    public function WarehouseUpdate(Request $request)
    {
        $warehouse_id = $request['id'];
       $data = Add::where('p_id',0)->select('id','p_id','area_name')->get()->toArray();

        $res = Warehouse::where('warehouse_id',$warehouse_id)->select()->get()->toArray();
        return view('warehouse.WarehouseUpdate',['res'=>$res,'data'=>$data]);
    }
}
