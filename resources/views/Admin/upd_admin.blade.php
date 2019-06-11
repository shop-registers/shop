<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/dsh/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/dsh/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/dsh/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/dsh/css/animate.css" rel="stylesheet">
    <link href="/dsh/css/style.css?v=4.1.0" rel="stylesheet">


</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <h2><b>修改用户信息：</b></h2>
            <div class="ibox-content">
                {{--                <form   class="form-horizontal">--}}
                <div class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">账号：</label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="您的账号" name="name" value="{{$res->name}}" class="form-control">
                            <span id="names"></span>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$res->id}}">
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">密码：</label>
                        <div class="col-sm-10">
                            <input type="password" placeholder="您的密码"  value="{{$res->pwd}}"  name="pwd" class="form-control">
                            <span id="pwd"></span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">邮箱：</label>

                        <div class="col-sm-10">
                            <input type="email" placeholder="您的邮箱"  value="{{$res->email}}"  class="form-control" name="email">
                            <span id="email"></span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">电话：</label>

                        <div class="col-sm-10">
                            <input type="tel" name="tel"  value="{{$res->tel}}"  placeholder="您的电话" class="form-control">
                            <span id="tel"></span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">姓名：</label>

                        <div class="col-sm-10">
                            <input type="text" name="real_name"  value="{{$res->real_name}}"  placeholder="您的真实姓名" class="form-control">
                            <span id="real_name"></span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary but" type="submit" >保存内容</button>
                            <button class="btn btn-white" type="reset">取消</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--                </form>--}}
        </div>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
<script src="/dsh/jq.js"></script>
<script src="/dsh/layer-v3.1.1/layer/layer.js"></script>
<script>
    $(document).on("click",".but",function(){
        var name = $("[name='name']").val();
        var pwd = $("[name='pwd']").val();
        var email = $("[name='email']").val();
        var real_name = $("[name='real_name']").val();
        var tel = $("[name='tel']").val();
        var id = $("[name='id']").val();
        $.ajax({
            url:"/upd",
            data:{name:name,pwd:pwd,email:email,real_name:real_name,tel:tel},
            type:"get",
            dataType:"json",
            success:function(data)
            {

                if(data == 1)
                {
                    layer.alert('添加成功', {icon: 1});
                }
                str = data.msg;
                var arr = str.splice(',');
                // alert(arr);return;
                for(var i=0;i<arr.length;i++)
                {
                    // alert(arr[i]);return;
                    if(arr[i]=='name')
                    {
                        layer.tips('名字不能为空、最小4位字符', '#names');
                        return false;

                    }
                    if(arr[i]=='names')
                    {
                        layer.tips('账号已注册', '#names');
                        return false;

                    }
                    if(arr[i]=='pwd')
                    {
                        layer.tips('密码不能为空、最小8位字符', '#pwd');
                        return false;
                    }
                    if(arr[i]=='email')
                    {
                        layer.tips('邮箱不能为空、格式不对', '#email');
                        return false;
                    }
                    if(arr[i]=='emails')
                    {
                        layer.tips('邮箱已注册', '#email');
                        return false;
                    }
                    if(arr[i]=='tel')
                    {
                        layer.tips('号码不能为空、必须十一位数字组成', '#tel');
                        return false;
                    }
                    if(arr[i]=='real_name')
                    {
                        layer.tips('必须汉子,最小两位', '#real_name');
                        return false;
                    }

                }
            }
        })
    })


</script>