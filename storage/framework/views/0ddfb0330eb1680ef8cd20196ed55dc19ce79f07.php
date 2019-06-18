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
                           <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th><input type="checkbox"></th>

                                <th><?php echo e($v['order_sn']); ?></th>
                                <th><?php echo e($v['customer_name']); ?></th>
                                <th><?php echo e($v['shipping_user']); ?></th>
                                <th><?php echo e($v['province']); ?></th>
                                <th><?php echo e($v['city']); ?></th>
                                <th><?php echo e($v['address']); ?></th>
                                <th><?php echo e($v['order_money']); ?></th>
                                <th><?php echo e($v['order_num']); ?></th>
                                <th>
                                    <?php switch($v['payment_method']):
                                        case (0): ?>
                                        货到付款
                                        <?php break; ?>
                                        <?php case (1): ?>
                                        余额
                                        <?php break; ?>
                                        <?php case (2): ?>
                                        网银
                                        <?php break; ?>
                                        <?php case (3): ?>
                                        支付宝
                                        <?php break; ?>
                                        <?php case (4): ?>
                                        微信
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                </th>
                                <th>
                                    <?php switch($v['shipping']):
                                        case (0): ?>
                                        未发货
                                        <?php break; ?>
                                        <?php case (1): ?>
                                        已发货
                                        <?php break; ?>
                                        <?php case (2): ?>
                                        已取消
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                </th>
                                <th>
                                    <?php switch($v['order_status']):
                                        case (0): ?>
                                        待确认
                                        <?php break; ?>
                                        <?php case (1): ?>
                                        已确认
                                        <?php break; ?>
                                        <?php case (2): ?>
                                        已取消
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                 </th>
                                <th><?php echo e($v['create_time']); ?></th>
                                <th>
                                    <a href="orderUpdate?id=<?php echo e($v['order_id']); ?>">
                                    <li>
                                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                      <span class="glyphicon-class"></a></span>
                                    </li>


                   
                                </th>
                                <th>
                                    
                                    <a href="orderDelete?id=<?php echo e($v['order_id']); ?>">
                                    <li>
                                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                      <span class="glyphicon-class"></span>
                                    </li>
                                    </a>
                                </th>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>

                        </table>
                        <?php echo e($data->links()); ?>

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
