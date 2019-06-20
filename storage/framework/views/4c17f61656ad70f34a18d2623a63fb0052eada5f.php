<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - FooTable</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>菜单列表</h5>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">选项 01</a>
                                    </li>
                                    <li><a href="#">选项 02</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="搜索表格...">

                            <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                <thead>
                                        <tr>
                                            <th>菜单ID</th>
                                            <th>菜单名称</th>
                                            <th>父菜单ID</th>
                                            <th>父菜单名称</th>
                                            <th>是否显示</th>
                                            <th>操作</th>
                                            <th>查看子菜单</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeX">
                                            <td class="id" value="<?php echo e($v['id']); ?>"><?php echo e($v['id']); ?></td>
                                            <td><?php echo e($v['name']); ?></td>
                                            <td><?php echo e($v['pid']); ?></td>
                                            <td class="center"><?php echo e($v['id']); ?></td>
                                            <td class="center"><?php echo e($v['is_show']); ?></td>
                                            <td class="center">
                                                <button class="del" value="<?php echo e($v['id']); ?>" >删除</button>
                                                <button class="update" value="<?php echo e($v['id']); ?>" >编辑</button>
                                            </td>
                                            <td>
                                                 <button data-toggle="dropdown" class="btn btn-white dropdown-toggle zi" value="<?php echo e($v['id']); ?>" type="button">查看子菜单 <span class="caret"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- 全局js -->
    <script src="js/jquery.min.js?v=2.1.4"></script>
    <script src="js/bootstrap.min.js?v=3.3.6"></script>
    <script src="js/plugins/footable/footable.all.min.js"></script>

    <!-- 自定义js -->
    <script src="js/content.js?v=1.0.0"></script>
    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });

        //删除
        $(".del").click(function(){
            var id=$(this).val();
            $.ajax({ 
                    url: "<?php echo e(url('del_menu')); ?>" , 
                    type: 'POST',
                    data: { _token : '<?php echo csrf_token()?>',id:id},
                    dataType: 'json', 
                    success: function(data){ 
                        console.log(data); 
                        if(data==2)
                        {
                            alert("存在子菜单，删除失败!!");
                        }else if(data==1){
                           alert("删除成功"); 
                           go.history(0);
                        }else{
                           alert("删除失败"); 
                        }
                    }, 
                    error: function(xhr, type){ 
                        alert('Ajax error!') 
                    } 
            });
        })
        //修改
        $(".update").click(function(){
            var id=$(this).val();
            $.ajax({ 
                    url: "<?php echo e(url('update_menu')); ?>", 
                    type: 'post',
                    data: { _token : '<?php echo csrf_token()?>',id:id},
                    dataType: 'json', 
                    success: function(data){ 
                        // console.log(data);
                        if(data==2)
                        {
                            alert("存在子菜单，编辑失败！！");
                        }else{
                            window.location='update_menu1?id='+id;
                        }
                    }, 
                    error: function(xhr, type){ 
                        alert('Ajax error!') 
                    } 
            });
        })


//查看子菜单
        $(".zi").click(function()
        {
            var id=$(this).val();   //获取菜单id
            var name_sum=[];
            //ajax方法
            $.ajax({ 
                    url: "<?php echo e(url('submenu_list')); ?>" , 
                    type: 'POST',
                    data: { _token : '<?php echo csrf_token()?>',id:id},
                    dataType: 'json', 
                    success: function(data){ 
                        // console.log(data); 
                        if(data==0){
                           alert("我没有子菜单了");
                        }
                        $.each(data,function(i,val){
                            name_sum+=val.name+"\n";
                        })
                        alert(name_sum);
                    }, 
                    error: function(xhr, type){ 
                        alert('Ajax error!') 
                    } 
            });     
       })

    </script>

    
    

</body>

</html>
