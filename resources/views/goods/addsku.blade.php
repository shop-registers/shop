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
        <div class="row">
            <div class="col-sm-12">
               <div id="navtab1" style="width: 960px; margin:0 auto; padding:20px; border: 1px solid #A3C0E8;">
                <select name="type_id" class="type">
                    @foreach ($type as $info)
                    <option value="{{$info->id}}">{{$info->type_name}}</option>
                    @endforeach
                </select>
    <div title="扩展信息" tabid="tabItem3">
        <div id="Div1">
        </div>
        <div id="tables">
            <form>
                <table id="t01" class="table table-striped">
                    
                </table>
                <button type='submit' id='Button2' class='btn btn-w-m btn-primary l-button'>提交</button>
            </form>
        </div>
    </div>
</div>
            </div>
        </div>
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
                url:"changeattr",
                data:{id:id},
                type:"GET",
                dataType:"json",
                success:function(res){
                    $.each(res,function(k,v){
                        v.attr_desc=v.attr_desc.split(',');
                    })
                    var str="<div position='center'><div style='padding: 5px 8px;' class='div_content'><div class='div_contentlist'>";
                    var tables="<tr>";
                    $.each(res,function(k,v){
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

                    tables+="<th>成本价</th>";
                    tables+="<th>库存</th>";
                    tables+="</tr>";
                    $('#t01').html(tables);
                    $('#Div1').html(str);
                }
            })
        })
        $(document).on('click','#Button1',function(){
            var ids=[];
            $('.Father_Item0 .chcBox_Width:checked').each(function(){
                ids.push($(this).val());
            })
            var tr="<tr>";
            $.each(ids,function(k,v){
                tr+="<td value='"+v+"'>"+v+"</td>";    
            })
            tr+="<td><input type='text' name='price'></td>";
            tr+="<td><input type='text' name='inventory'></td>";
            tr+="</tr>";
            $('#t01').append(tr);
        })
        $(document).on('click','#Button2',function(){
            id=$('.type').val();
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
                            tr+="<td value='"+v+"'>"+v+"</td>";    
                        })
                        tr+="<td><input type='text' name='price'></td>";
                        tr+="<td><input type='text' name='inventory'></td>";
                        tr+="</tr>";
                    })
                    $('#t01').append(tr);
                }
            })
        });
    </script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/liandong.js"></script>

</body>

</html>
