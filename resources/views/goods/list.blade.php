 <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 基础表格</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="../css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>自定义响应式表格</h5>
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
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary" style="margin-right: 10px;"> 搜索</button> <a href="add_attr"><button type="button" class="btn btn-sm btn-primary"> 添加属性值</button></a></span>

                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th></th>
                                        <th>商品名称</th>
                                        <th>商品描述</th>
                                        <th>商品售价</th>
                                        <th>商品划线价</th>
                                        <th>商品主图</th>
                                        <th>上下架状态</th>
                                        <th>商品库存</th>
                                        <th>商品所属分类</th>
                                        <th>商品所属品牌</th>
                                        <th>商品添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($goodsinfo as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="i-checks" name="input[]">
                                        </td>
                                        <td>{{$item->good_name}}</td>
                                        <td><span class="pie">{{$item->good_desc}}</span></td>
                                        <td><span class="pie">{{$item->good_price}}</span></td>
                                        <td><span class="pie">{{$item->good_opening_price}}</span></td>
                                        <td><img src="../uploads/{{$item->good_img}}" width="50px" height="50px"></td>
                                        <td>
                                            @if($item->good_stauts==1)
                                            上架
                                            @else
                                            下架
                                            @endif
                                        </td>
                                        <td>{{$item->good_inventory}}</td>
                                        <td>{{$item->type_name}}</td>
                                        <td>{{$item->brand_name}}</td>
                                        <td>{{$item->good_addtime}}</td>
                                        <td><a href="good_del?id={{$item->id}}"><button type="button" class="btn btn-sm btn-primary"> 删除</button></a>
                                            <a href="good_upd?id={{$item->id}}"><button type="button" class="btn btn-sm btn-primary"> 修改</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
{{ $goodsinfo->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- 全局js -->
    <script src="../js/jquery.min.js?v=2.1.4"></script>
    <script src="../js/bootstrap.min.js?v=3.3.6"></script>



    <!-- Peity -->
    <script src="../js/plugins/peity/jquery.peity.min.js"></script>

    <!-- 自定义js -->
    <script src="../js/content.js?v=1.0.0"></script>


    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js"></script>

    <!-- Peity -->
    <script src="../js/demo/peity-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    
    

</body>

</html>
