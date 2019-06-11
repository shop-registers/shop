<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/dshs/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/dshs/css/font.css">
    <link rel="stylesheet" href="/dshs/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/dshs/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/dshs/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form layui-form-pane" action="javascript:void(0)">
        <div class="layui-form-item">
            <label for="name" class="layui-form-label">
                <span class="x-red">*</span>角色名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="role" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">
                拥有权限
            </label>
            <table  class="layui-table layui-input-block">
                <tbody>
                @foreach($res as $val)
                <tr>
                    <td>
                        <input type="checkbox" name="like1[write]" class="dian" lay-skin="primary" value="{{$val->id}}" title="{{$val->name}}">
                    </td>
                    <td>
                        <div class="layui-input-block">
                        @foreach($val['son'] as $vals)
                            <input name="id[]" lay-skin="primary" type="checkbox" value="{{$vals->id}}" title="{{$vals->name}}" >
                        @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn"  lay-submit lay-filter="add">增加</button>
        </div>
    </form>
</div>
{{--<script src="/dsh/jq.js"></script>--}}
<script>

</script>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //自定义验证规则
        form.verify({
            nikename: function(value){
                if(value.length < 5){
                    return '昵称至少得5个字符啊';
                }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
        });

        //监听提交
        form.on('submit(add)', function(data){
            // console.log(data);
            // //发异步，把数据提交给php
            // layer.alert("增加成功", {icon: 6},function () {
            //     // 获得frame索引
            //     var index = parent.layer.getFrameIndex(window.name);
            //     //关闭当前frame
            //     parent.layer.close(index);
            // });
            var arr = [];
            var role = $("[name = 'role']").val();
            $.each($('input:checkbox:checked'),function(){
                arr.push($(this).val());
            });
            // console.log(arr);
            // return;
            $.ajax({
                url:"/add_roles",
                method:"post",
                data:{id:arr,role:role},
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                success:function(data)
                {
                    alert(data);
                }

            });
            return false;
        });


    });
</script>

</body>

</html>