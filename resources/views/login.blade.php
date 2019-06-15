<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>

   <script src="https://cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js"></script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">h</h1>

            </div>
            <h3>欢迎来到电商后台</h3>

            <form class="m-t" role="form">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                <div class="form-group">
                    <input type="text" class="form-control name" placeholder="用户名" required="" name="name">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control pwd" placeholder="密码" required="" name="password">
                </div>
                <button type="button" class="btn btn-primary block full-width m-b submit">登 录</button>


                <p class="text-muted text-center"> 
                <a href="javascript:;"><small>重置密码  </small></a> | | <a href="javascript:;">注册一个新账号</a>
                </p>

            </form>
        </div>
    </div>

    <!-- 全局js -->
    <script src="js/jquery.min.js?v=2.1.4"></script>
    <script src="js/bootstrap.min.js?v=3.3.6"></script>

    <script>
var a=0;
//密码验证方法
        $(".pwd").blur(function(){
             var pwd=$(this).val();
             var ret=/^[0-9a-zA-Z_]{6,30}$/;
             if((pwd.length)<=0)
             {
                 alert("密码不能为空");
                 a=0;
             }else{
                if(!ret.test(pwd)){
                   alert('格式错误,大小写字母和数字，至少6位最多30位');
                   a=0;
                }
             }
             a=1;
        })
    

   //点击登录按钮
   $(".submit").click(function(){
    if(a==0)
    {
        alert('登录失败')
    }else{
        //验证form表单通过  提交数据
        var name=$(".name").val();
        var pwd=$(".pwd").val();
        $.ajax({ 
        url: "login_do", 
        type: 'POST',
        data: { _token : '<?php echo csrf_token()?>',name:name,pwd:pwd},
        success: function(data){ 
            console.log(data);
            if(data==1)
            {
                window.location.href = "index";
            }else{
                alert("登录失败");
            }
        }, 
        error: function(xhr, type){ 
            alert('Ajax error!') 
        } 
      });
    }
   })
       
    
    


    </script>
    

</body>

</html>
