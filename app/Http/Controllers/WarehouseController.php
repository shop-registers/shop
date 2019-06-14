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
            $data = Add::where('p_id',0)->select()->get()->toArray();
            $info = shop::select()->get()->toArray();
            $res = Warehouse::where('warehouse_id',$warehouse_id)->select()->get()->toArray();
            // print_r($res);die;
            $warehouse = $res[0]['warehouse_area'];
            // print_r($warehouse);die;
            $warehouse = explode(',',$warehouse);
            // print_r($warehouse);die;
            return view('warehouse.WarehouseUpdate',['res'=>$res,'data'=>$data,'info'=>$info,'warehouse'=>$warehouse]);
        
    }
    public function WarehouseUpdates(Request $request)
    {
        //  if($request->isMethod('post'))
        // {
            
                $data = $request->post();
                $warehouse_id = $data['warehouse_id'];
                // $warehouse_id = $_POST['warehouse_id'];
                // print_r($data);die;
                $data = [
                    'warehouse_name'=>$data['warehouse_name'],
                'warehouse_code'=>$data['warehouse_code'],
                'warehouse_status'=>$data['warehouse_status'],
                'warehouse_province'=>$data['warehouse_province'],
               'warehouse_city'=>$data['warehouse_city'],
                'warehouse_area'=>$data['warehouse_area'],
                ];
                // print_r($data);die;
                $res = Warehouse::where('warehouse_id',$warehouse_id)->update($data);
                if($res)
                {
                   echo 1;die;
                }
                else
                {
                     echo 2;die;
                }      
                  
        }
    }
