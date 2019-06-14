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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>

                                <th></th>
                                <th>仓库名称</th>
                                <th>仓库编码</th>
                                <th>仓库是否启用</th>
                                <th>仓库所在地区</th>
                                <th>仓库所在区</th>
                                <th>仓库服务地区</th>
                                <th>操　　作</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($data as $v)
                                <tr>
                                <th></th>
                                <th>{{$v['warehouse_name']}}</th>
                                <th>{{$v['warehouse_code']}}</th>
                                <th>
                                    @if($v['warehouse_status'] == 1)
                                    启用
                                    @else
                                    禁用
                                    @endif

                                </th>
                                <th>{{$v['warehouse_province']}}</th>
                                <th>{{$v['warehouse_city']}}</th>
                                <th>{{$v['warehouse_area']}}</th>
                                <th>
                                    
                                    <a href="/WarehouseDel?id={{$v['warehouse_id']}}">
                                        
                                        
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        <span class="glyphicon-class"></span>
                                    
                                    </a>　
                                    <a href="/WarehouseUpdate?id={{$v['warehouse_id']}}">
                                        
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        <span class="glyphicon-class"></span>
                                        
                                    </a>
                                </th>
                                <th>
                                    
                                </th>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div align="center">
                            {{ $data->links() }}
                        </div>
                        

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
