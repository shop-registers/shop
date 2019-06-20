<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 基本表单</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="../css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css?v=4.1.0" rel="stylesheet">
    
    <link type="text/css" rel="stylesheet" href="../css/liandong.css">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
    <form action="addsku" method="POST">
        <div class="row">
            <div class="col-sm-12">
               <div id="navtab1" style="width: 960px; margin:0 auto; padding:20px; border: 1px solid #A3C0E8;">
                <div class="form-group">
                    <div class="col-sm-10">
                        <select class="form-control m-b type" name="type_id">
                            <option>请选择分类</option>
                            <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($info->id); ?>"><?php echo e($info->type_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-sm-10" id="goods">
                        
                            
                        
                    </div>
                </div>
    <div title="扩展信息" tabid="tabItem3">
        <div id="Div1">
        </div>
        <div id="tables">
            
                <?php echo csrf_field(); ?>
                <table id="t01" class="table table-striped">
                    
                </table>
                <button type='submit'  class='btn btn-w-m btn-primary l-button'>提交</button>
            
        </div>
    </div>
    </form>
    <input type="hidden" name="limit_id" id="limit_id" value="0">
</div>
            </div>
        </div>
        
    </div>
    <div id="t03">
        
                            
            
    </div>
    <div id="modal-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 b-r">
                            <h3 class="m-t-none m-b">登录</h3>
                            <form role="form">
                                <div class="form-group">
                                    <label>用户名：</label>
                                    <input type="email" placeholder="请输入用户名" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>密码：</label>
                                    <input type="password" placeholder="请输入密码" class="form-control">
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>登录</strong>
                                    </button>
                                    <label>
                                        <input type="checkbox" class="i-checks">自动登录</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <h4>还不是会员？</h4>
                            <p>您可以注册一个账户</p>
                            <p class="text-center">
                                <a href="form_basic.html"><i class="fa fa-sign-in big-icon"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <script src="../js/jquery.min.js?v=2.1.4"></script>
    <script src="../js/bootstrap.min.js?v=3.3.6"></script>

    <!-- 自定义js -->
    <script src="../js/content.js?v=1.0.0"></script>

    <!-- iCheck -->
    <script>
        $(document).on('change','.type',function(){
            id=$(this).val();
            $.ajax({
                url:"changegood",
                data:{id:id},
                type:"GET",
                dataType:"json",
                success:function(res){
                    var str='<select class="form-control m-b good" name="good_id"><option>请选择商品</option>';
                    $.each(res,function(k,v){
                        str+='<option value="'+v.id+'">'+v.good_name+'</option>';
                    })
                    str+="</select>";
                    $('#goods').html(str);
                }
            })
        })
        $(document).on('change','.good',function(){
            id=$(this).val();
            $.ajax({
                url:"changeattr",
                data:{id:id},
                type:"GET",
                dataType:"json",
                success:function(res){
                    $.each(res.attr,function(k,v){
                        v.attr_desc=v.attr_desc.split(',');
                    })
                    var str="<div position='center'><div style='padding: 5px 8px;' class='div_content'><div class='div_contentlist'>";
                    var tables="<tr>";
                    var tables2='<div id="navtab2" style="width: 960px; margin:0 auto; padding:20px; border: 1px solid #A3C0E8;"><table id="t02" class="table table-striped"><tr><th>sku_id</th><th>sku_code</th><th>sku属性</th><th>价格</th><th>库存</th></tr>';
                    $.each(res.attr,function(k,v){
                        tables+="<th>"+v.attr_name+"</th>";
                        str+="<ul class='Father_Title'><li>"+v.attr_name+"</li></ul>";
                        str+="<ul class='Father_Item0'>";
                        $.each(v.attr_desc,function(key,value){
                            key=key+1;
                            str+="<li class='li_width'><label><input id='"+k+"' name='"+v.attr_name+"' type='radio' class='chcBox_Width' value='"+value+"' />"+value+"<span class='li_empty'></span></label></li>";    
                        })
                        str+="</ul><br/>";
                    })
                    str+="</div><div class='div_contentlist2'><ul><li><div id='createTable'></div></li></ul><ul><li><button type='button' id='Button1' class='btn btn-w-m btn-primary l-button' style='margin-right:10px'>生成</button><button type='button' id='Button2' class='btn btn-w-m btn-primary l-button' style='margin-right:10px'>一键生成</button></li></ul></div></div></div>";
                    $.each(res.good_sku,function(k,v){
                        tables2+='<tr>';
                        tables2+='<td>'+v.id+'</td>';
                        tables2+='<td>'+v.sku_id+'</td>';
                        tables2+='<td>'+v.sku_desc+'</td>';
                        tables2+='<td>'+v.price+'</td>';
                        tables2+='<td>'+v.inventory+'</td>';
                        tables2+='</tr>';
                    })
                    tables+="<th>成本价</th>";
                    tables+="<th>库存</th>";
                    tables+="</tr>";
                    tables2+='</table></div>';
                    $('#t01').html(tables);
                    $('#t03').html(tables2);
                    $('#Div1').html(str);
                }
            })
        })
        $(document).on('click','#Button1',function(){
            var ids=[];
            var limit_id=$('#limit_id').val();
            $('.Father_Item0 .chcBox_Width:checked').each(function(){
                ids.push($(this).val());
            })
            var tr="<tr>";
            $.each(ids,function(k,v){
                tr+="<td><input name='"+limit_id+"[]' value='"+v+"'></td>";    
            })
            tr+="<td><input type='text' name='price[]'></td>";
            tr+="<td><input type='text' name='inventory[]'></td>";
            tr+="</tr>";
            $('#t01').append(tr);
            $('#limit_id').val(Number(limit_id)+1);
        })
        $(document).on('click','#Button2',function(){
            id=$('.good').val();
            $.ajax({
                url:"allsku",
                data:{id:id},
                dataType:"json",
                type:"GET",
                success:function(res){
                    
                    $.each(res,function(k,v){
                        res[k]=v.split(',');
                    })
                    console.log(res);
                    var tr="";
                    $.each(res,function(key,value){
                        tr+="<tr>";
                        $.each(value,function(k,v){
                            tr+="<td><input name='"+key+"[]' value='"+v+"'></td>";    
                        })
                        tr+="<td><input type='text' name='price[]' placeholder='请输入价格'></td>";
                        tr+="<td><input type='text' name='inventory[]' placeholder='请输入库存'></td>";
                        tr+="</tr>";
                    })
                    $('#t01').html(tr);
                }
            })
        });
    </script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/liandong.js"></script>

</body>

</html>
