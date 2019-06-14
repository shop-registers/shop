<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> -订单列表</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>订单列表</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="table_basic.html#">选项1</a>
                            </li>
                            <li><a href="table_basic.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs" class="btn">
                            <select class="input-sm form-control input-s-sm inline btn">
                                <option value="0" class="btn">请选择</option>
                                <option value="1" >订单编辑</option>
                                <option value="2" >订单状态管理</option>
                            </select>
                        </div>
                        <div class="col-sm-4 m-b-xs">

                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>

                                <th></th>
{{--                                <th>编号</th>--}}
                                <th>订单编号</th>
                                <th>会员名称</th>
                                <th>收货人姓名</th>
                                <th>省</th>
                                <th>区</th>
                                <th>详细地址</th>
                                <th>订单金额</th>
                                <th>订单数量</th>
                                <th>支付方式</th>
                                <th>发货状态</th>
                                <th>订单状态</th>
                                <th>下单时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($data as $v)
                            <tr>
                                <th><input type="checkbox"></th>
{{--                                <th>{{$v['order_id']}}</th>--}}
                                <th>{{$v['order_sn']}}</th>
                                <th>{{$v['customer_name']}}</th>
                                <th>{{$v['shipping_user']}}</th>
                                <th>{{$v['province']}}</th>
                                <th>{{$v['city']}}</th>
                                <th>{{$v['address']}}</th>
                                <th>{{$v['order_money']}}</th>
                                <th>{{$v['order_num']}}</th>
                                <th>
                                    @switch($v['payment_method'])
                                        @case(0)
                                        货到付款
                                        @break
                                        @case(1)
                                        余额
                                        @break
                                        @case(2)
                                        网银
                                        @break
                                        @case(3)
                                        支付宝
                                        @break
                                        @case(4)
                                        微信
                                        @break
                                    @endswitch
                                </th>
                                <th>
                                    @switch($v['shipping'])
                                        @case(0)
                                        未发货
                                        @break
                                        @case(1)
                                        已发货
                                        @break
                                        @case(2)
                                        已取消
                                        @break
                                    @endswitch
                                </th>
                                <th>
                                    @switch($v['order_status'])
                                        @case(0)
                                        待确认
                                        @break
                                        @case(1)
                                        已确认
                                        @break
                                        @case(2)
                                        已取消
                                        @break
                                    @endswitch
                                 </th>
                                <th>{{$v['create_time']}}</th>
                                <th>
                                    <a href="orderUpdate?id={{$v['order_id']}}">
                                    <li>
                                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                      <span class="glyphicon-class"></a></span>
                                    </li>


                   
                                </th>
                                <th>
                                    
                                    <a href="orderDelete?id={{$v['order_id']}}">
                                    <li>
                                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                      <span class="glyphicon-class"></span>
                                    </li>
                                    </a>
                                </th>
                            </tr>
                            @endforeach

                            </tbody>

                        </table>
                        {{ $data->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- 全局js -->
<script src="js/jquery.min.js?v=2.1.4"></script>
<script src="js/bootstrap.min.js?v=3.3.6"></script>



<!-- Peity -->
<script src="js/plugins/peity/jquery.peity.min.js"></script>

<!-- 自定义js -->
<script src="js/content.js?v=1.0.0"></script>


<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<!-- Peity -->
<script src="js/demo/peity-demo.js"></script>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
    $(function(){
        $("select").on("change",function(){
            var id = $(this).val();
            if(id == 0 )
            {
                //跳转到订单列表
                location.href = "orderlist";
            }

            if(id == 1)
            {
                //跳转到订单编辑
                location.href=("orderediting");

            }

            if(id == 2)
            {
                // 跳转到订单状态
                location.href=("orderstatus");
            }

        })
    })
</script>




</body>

</html>
