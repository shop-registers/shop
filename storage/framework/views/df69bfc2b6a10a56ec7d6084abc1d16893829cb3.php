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

            <form class="m-t" role="form" action="login_do" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" required="" name="name">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required="" id="pwd" name="password">
                </div>
                <!-- 滑动验证 -->
                <div  class="form-group" id="c1"></div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>


                <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
                </p>

            </form>
        </div>
    </div>

    <!-- 全局js -->
    <script src="js/jquery.min.js?v=2.1.4"></script>
    <script src="js/bootstrap.min.js?v=3.3.6"></script>

    <script>
    //密码验证
    $("#pwd").blur(function(){
         var pwd=$("#pwd").val();
         var ret = /^[a-zA-Z][a-zA-Z0-9_]{5,30}$/;
            if(ret.test(pwd)){

                alert('ok');

            }else{

                alert('wrong,大小写字母和数字，至少6位最多30位');die;

            }
    })
    //密码验证

    // 滑块验证
        var myCaptcha = _dx.Captcha(document.getElementById('c1'), {
            appId: '46bd7c134151feb0265fd1ba9e2f5b7c', //appId，在控制台中“应用管理”或“应用配置”模块获取
            success: function (token) {
              // console.log('token:', token)
            }
        })
    // 滑块验证
    


    </script>
    

</body>

</html>
