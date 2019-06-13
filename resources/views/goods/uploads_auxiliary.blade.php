<!DOCTYPE html>    
<html>    
<head>    
<meta charset="UTF-8">    
<title>showImages</title>    
<style type="text/css">
    .box{
        width: 1000px;
        height: 500px;
        height: 1px solid #ccc;
    }
</style>
    <link rel="shortcut icon" href="favicon.ico"> <link href="../../css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="../../css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="../../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../../css/animate.css" rel="stylesheet">
    <link href="../../css/style.css?v=4.1.0" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>    
<script type="text/javascript">
    function fileSelect() {
        document.getElementById("fileToUpload").click(); 
    }
    
    function fileSelected(e) {
      var from=new FormData($('#form_face')[0]);
      var file=$('#fileToUpload')[0].files[0];
      var id=$('#goods_id').val();
      from.append('file',file);
      from.append('goods_id',id);
      $.ajax({
        url:"../multiUploadImg",
        data:from,
        type:"POST",
        contentType: false,
        processData: false,
        success:function(res){
            console.log(res);
         var str='<tr><td><img src="../../uploads/'+res+'" width="200px" height="200px"></td><td><a href="../delete_img/"><button type="button" class="btn btn-sm btn-primary">删除</button></a></td></tr>';
          $('#t01').append(str);
        }
      })
    }
  </script> 
</head>    
    <body> 
       
        <div class="ibox-content">
        <div style="width: 140px;height: 150px;border:1px solid #ccc; text-align: center;line-height: 150px;cursor:pointer;" onclick="fileSelect()" id="userimg">点击此处添加图片
        <form id="form_face" enctype="multipart/form-data" style="width:auto;">
            {{ csrf_field() }}
            <input type="hidden" name="goods_id" id="goods_id" value="{{$id}}">
          <input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected()" style="display:none;">
        </form>
        </div>
        </div>
        <div class="ibox-content">
            <table id="t01" style="width:80%;margin-left: 200px;" class="table table-striped table-bordered">
                <tr>
                    <th>图片</th>
                    <th>操作</th>
                </tr>
                @if(empty($info[0]))
                <tr>
                    <td><h4>暂无数据</h4></td>
                </tr>
                @else
                    @foreach($info as $item)
                    <tr  id="{{$item->id}}">
                        <td><img src="../../uploads/{{$item->img_src}}" width="200px" height="200px"></td>
                        <td><a href="../delete_img/{{$id}}/{{$item->id}}"><button type="button" class="btn btn-sm btn-primary">删除</button></a></td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </body>    
</html>
