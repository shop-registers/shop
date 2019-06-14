<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Add;
use App\Models\shop;
use DB;


class OrderController extends Controller
{
    //首页展示
    public function index()
    {
        return view('orderlist.index');
    }
    //订单列表
    public function orderList()
    {
        $data = Order::paginate(5);
        return view('orderlist.orderlist',['data'=>$data]);
    }
    //订单编辑
    public function orderAdd(Request $request)
    {
        if($request->post())
        {
            //接值
            $data = $request['area_name'];
            // print_r($data);die;
            $res = shop::where('area_name',$data)->select()->get()->toArray();
           // print_r($res);die;
            $info = DB::table('shop_areas')->where('p_id',$res[0]['id'])->select()->get()->toArray();
            return $info;
        }
        $data = Add::where('p_id',0)->select('id','p_id','area_name')->get()->toArray();

        return view('orderlist.orderAdd',['data'=>$data]);
    }
    //添加订单
    public function orderAdds(Request $request)
    {   
        //接值
        $data = $request->post();
        $shipping_tel = $data['shipping_tel'];
        $shipping_tel = substr($shipping_tel,-4);
        $time = time();
        $time = $time.$shipping_tel;

        //支付金额
        $payment_money = $data['order_money']+$data['shipping_money']-$data['district_money'];
        $data = [
            'order_sn' => $time,
            'customer_name' => $data['customer_name'],
            'shipping_tel' => $data['shipping_tel'],
            'shipping_user' => $data['shipping_user'],
            'province' => $data['area_name'],
            'city' =>$data['city'],
            'address'=>$data['address'],
            'order_money' => $data['order_money'],
            'payment_method' =>$data['payment_method'],
            'shipping_comp_name' => $data['shipping_comp_name'],
            'shipping_sn' => $time,
            'district_money' => $data['district_money'],
            'shipping_money'=> $data['shipping_money'],
            'payment_money' => $payment_money,
        ];
        
        if(Order::insert($data))
        {
            echo 1;die;
        }
        else
        {
            echo 2;die;
        }
    }
    //修改订单
    public function orderUpdate(Request $request)
    {
            if($request->isMethod('post'))
            {
                $data = $request->post();
                $data = [
                    'customer_name'=>$data['customer_name'],
                    // 'order_id'=>$data['order_id'],
                    'shipping_user'=>$data['shipping_user'],
                    'shipping_tel'=>$data['shipping_tel'],
                    'province'=>$data['area_name'],
                    'city'=>$data['one'],
                    'address'=>$data['address'],
                    'order_money'=>$data['order_money'],
                    'district_money'=>$data['district_money'],
                    'shipping_money'=>$data['shipping_money'],
                    'shipping_comp_name'=>$data['shipping_comp_name'],  
                    'payment_method'=>$data['payment_method'],
                ];
                // print_r($data);die;
                $order_id = $_POST['order_id'];
                // print_r($data);die;
                // print_r($order_id);die;
                $res = Order::where('order_id',$order_id)->update($data);
                if($res)
                {
                   echo "<script>alert('修改成功');location.href='orderlist'</script>";
                }
                else
                {
                     echo "<script>alert('修改失败');location.href='orderlist'</script>";
                }
            }
            $order_id = $request->all();
            // print_r($order_id);die;
            $data = Order::where('order_id',$order_id)->select()->get()->toArray();
            // print_r($data);die;
            $res = shop::where('p_id',0)->select()->get()->toArray();
            $info = shop::select()->get()->toArray();
            // print_r($info);die;
            // print_r($data);die;
            return view('orderlist.orderUpdate',['data'=>$data,'res'=>$res,'info'=>$info]);
        
    }
}
