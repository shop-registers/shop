<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> - 评论详情</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="../css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>评论详情</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <div class="feed-element">
                            <div class="media-body ">
                                <small class="pull-right text-navy">{{$data->addtime}}</small>
                                <strong>{{$data->username}}</strong> 对 <strong>{{$data->good_name}}</strong> 发表评论
                                <br>
                                <div class="well">
                                    {{$data->content}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            回复评论
                            <form class="form-horizontal" id="form">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">用户名</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="usename" id="usename" disabled value="{{$data->username}}" class="form-control">
                                    </div>
                                </div>
                                <div>
                                    <input type="text" hidden value="{{$data->id}}" id="parentid" name="parentid">
                                    <input type="text" hidden value="{{$data->objectid}}" id="objectid" name="objectid">
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">回复内容</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" id="content" cols="121" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" type="button">保 存 内 容</button>
                                        <button class="btn btn-white" type="reset">重 置</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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


<!-- Peity -->
<script src="../js/plugins/peity/jquery.peity.min.js"></script>


<script>
    $(document).on('click','.btn-primary',function(){
        var parentid = $('#parentid').val();
        var objectid = $('#objectid').val();
        var content  = $('#content').val();

        $.ajax({
            url: '../commentadd',
            type: 'POST',
            data: {'_token':'{{csrf_token()}}',username:'admin',parentid:parentid,objectid:objectid,content:content},
            dataType: 'json',
            success:function(e){
                if(e == 1){
                    alert('回复成功')
                }
            }
        })
    })
</script>


</body>

</html>
