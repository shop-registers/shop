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
<style type="text/css">   
    .float{    
        float:left;    
        width : 200px;    
        height: 200px;    
        overflow: hidden;    
        border: 1px solid #CCCCCC;    
        border-radius: 10px;    
        padding: 5px;    
        margin: 5px;    
    }    
    img{    
        position: relative;    
    }    
    .result{    
        width: 200px;    
        height: 200px;    
        text-align: center;    
        box-sizing: border-box;    
    }   
  
  
    #file_input{  
        display: none;  
    }  
  
  
    .delete{  
        width: 200px;  
        height:200px;  
        position: absolute;  
        text-align: center;  
        line-height: 200px;  
        z-index: 10;  
        font-size: 30px;  
        background-color: rgba(255,255,255,0.8);  
        color: #777;  
        opacity: 0;  
        transition-duration: 0.7s;  
        -webkit-transition-duration: 0.7s;   
    }  
  
  
    .delete:hover{  
        cursor: pointer;  
        opacity: 1;  
    }  
  
  
        
</style>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>商品属性添加</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="POST" class="form-horizontal" action="good_upd" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$goodinfo->id}}">
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品所属分类</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="type_id" id="type">
                                    	<option>暂无</option>
                                        @foreach ($type as $info)
                                        <option value="{{$info->id}}" selected="{{$goodinfo->type_id == $info->id ? true:false}}">{{$info->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品所属品牌</label>
                                <div class="col-sm-10">
                                	<div id="t01">
                                    <select class="form-control m-b" name="brand_id">
                                        <option>暂无</option>
                                         @foreach ($type as $info)
                                        <option value="{{$info->id}}" selected="{{$goodinfo->brand_id == $info->id ? true:false}}">{{$info->type_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="good_name" value="{{$goodinfo->good_name}}"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品描述</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="good_desc" value="{{$goodinfo->good_desc}}"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品售价</label>
                                <div class="input-group m-b"><span class="input-group-addon">&yen;</span>
                                    <input type="text" class="form-control" name="good_price" value="{{$goodinfo->good_price}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品划线价</label>
                                <div class="input-group m-b"><span class="input-group-addon">&yen;</span>
                                    <input type="text" class="form-control" name="good_opening_price" value="{{$goodinfo->good_opening_price}}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品主图</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="good_img"> 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品上下架
                                </label>
                                <div class="col-sm-10">
                                    <div class="radio i-checks">
                                        <label>
                                            <input type="radio" value="0" name="good_status" checked="{{$goodinfo->good_status == 0?true:''}}"> <i></i>下架
                                            <input type="radio" value="1" name="good_status" checked="{{$goodinfo->good_status == 1?true:''}}"> <i></i>上架
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品库存</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="good_inventory" value="{{$goodinfo->good_inventory}}"> 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                </div>
                            </div>
                        </form>
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
    <script src="../js/plugins/iCheck/icheck.min.js"></script>
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
