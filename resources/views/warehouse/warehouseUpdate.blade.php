<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 订单添加</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">

    <style>
        .droppable-active {
            background-color: #ffe !important;
        }

        .tools a {
            cursor: pointer;
            font-size: 80%;
        }

        .form-body .col-md-6,
        .form-body .col-md-12 {
            min-height: 400px;
        }

        .draggable {
            cursor: move;
        }
    </style>

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-sm-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>仓库 修改</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_editors.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_editors.html#">选项1</a>
                            </li>
                            <li><a href="form_editors.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal m-t">
                    <!-- <form role="form" class=""> -->
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">仓库名称：</label>
                            <div class="col-sm-9">
                                <input type="text" name="warehouse_name" class="warehouse_name" value="{{$res[0]['warehouse_name']}}" ="请输入仓库名称">
                                <input type="hidden" value="{{$res[0]['warehouse_id']}}" class="warehouse_id">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">仓库编码：</label>
                            <div class="col-sm-9">
                                <input type="text" class="warehouse_code" name="warehouse_code" value="{{$res[0]['warehouse_code']}}">
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">仓库是否启用：
                            </label>

                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" {{$res[0]['warehouse_status'] == 1 ? "checked":""}} value="1" id="optionsRadios1" name="warehouse_status"  class="warehouse_status">是</label>
                                <label class="radio-inline">
                                    <input type="radio" {{$res[0]['warehouse_status'] == 2 ? "checked":""}} value="2" id="optionsRadios2" name="warehouse_status" class="warehouse_status">否</label>
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">仓库所在地区：</label>
                            <div class="col-sm-9">
                                省:
                                <select class="area_name" name="area_name">
                                    <option value="">请选择</option>
                                    @foreach($data as $v)
                                     @if($v['area_name'] == $res[0]['warehouse_province'])
                                    <option value="{{$v['area_name']}}" selected>{{$v['area_name']}}</option>
                                    @else
                                    <option value="{{$v['area_name']}}" >{{$v['area_name']}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                区:
                                <select class="one" name="one">
                                    <option value="">请选择</option>

                                    @foreach($info as $v)
                                    @if($v['area_name'] == $res[0]['warehouse_city'])
                                    <option value="{{$v['area_name']}}" selected >{{$v['area_name']}}</option>
                                    @else
                                    <option value="{{$v['area_name']}}" >{{$v['area_name']}}</option>
                                    @endif
                                    @endforeach

                                </select>

                            </div>
                        </div>


                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">仓库服务地区 ： </label>
                           
                            <div class="col-sm-9">
                            	 @foreach($data as $v)
                                 @if(in_array($v['area_name'],$warehouse))
                                <input type="checkbox" checked class="warehouse_area" name="warehouse_area" value="{{$v['area_name']}}">{{$v['area_name']}}
                                @else
                                <input type="checkbox" class="warehouse_area" name="warehouse_area" value="{{$v['area_name']}}">{{$v['area_name']}}
                                @endif
                                @endforeach
                            </div>
                            
                        </div>

                        
                        


                        <div class="hr-line-dashed"></div>


                        <div class="form-group draggable">
                            <div class="col-sm-12 col-sm-offset-3">
                                <button class="btn btn-primary con" >保存内容</button>
                                <button class="btn btn-white" type="submit">取消</button>
                            </div>
                        </div>
                    <!-- </form> -->
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- 全局js -->
<script src="js/jquery.min.js?v=2.1.4"></script>
<script src="js/bootstrap.min.js?v=3.3.6"></script>

<!-- 自定义js -->
<script src="js/content.js?v=1.0.0"></script>

<!-- jQuery UI -->
<script src="js/jquery-ui-1.10.4.min.js"></script>

<!-- From Builder -->
<script src="js/plugins/beautifyhtml/beautifyhtml.js"></script>

<script>


    $(document).on('click','.con',function () {
        var warehouse_name = $('.warehouse_name').val();
        var warehouse_code = $('.warehouse_code').val();
        var warehouse_status = $('input:radio[name="warehouse_status"]:checked').val();
        var warehouse_province = $('.area_name').val();
        var warehouse_city = $('.one').val();
         var warehouse_area = $("input:checkbox[name='warehouse_area']:checked").map(function(index,elem) {
            return $(elem).val();
        }).get().join(',');
         var warehouse_id = $('.warehouse_id').val();

        $.ajax({
            url:"WarehouseUpdates",
            data:{
                warehouse_name:warehouse_name,warehouse_code:warehouse_code,
                warehouse_status:warehouse_status,warehouse_province:warehouse_province,
                warehouse_city:warehouse_city,warehouse_area:warehouse_area,
                warehouse_id:warehouse_id
            },	
            type:"post",
            dataType:"json",

            success:function(res){
               if(res == 1)
                {
                    alert('修改成功');
                    location.href = "WarehouseShow";
                }
                else
                {
                    alert('修改失败');
                }
            }
         })
        

      
    })
    $(document).on('change',function(){
        //获取下拉框的值
        var area_name = $('.area_name').val();

        $.ajax({
            url:"orderAdd",
            data:{area_name:area_name},
            type:"get",
            dataType:"json",

            success:function (res) {
                var option = '';
                for (var i= 0; i < res.length;i++){ //循环返回值并组成数组信息
                    option +='<option value='+res[i]['area_name']+'>'+res[i]['area_name']+'</option>';
                }
                $('.one').html(option);
            }
        })
    })







    $(document).ready(function () {
        setup_draggable();

        $("#n-columns").on("change", function () {
            var v = $(this).val();
            if (v === "1") {
                var $col = $('.form-body .col-md-12').toggle(true);
                $('.form-body .col-md-6 .draggable').each(function (i, el) {
                    $(this).remove().appendTo($col);
                })
                $('.form-body .col-md-6').toggle(false);
            } else {
                var $col = $('.form-body .col-md-6').toggle(true);
                $(".form-body .col-md-12 .draggable").each(function (i, el) {
                    $(this).remove().appendTo(i % 2 ? $col[1] : $col[0]);
                });
                $('.form-body .col-md-12').toggle(false);
            }
        });

        $("#copy-to-clipboard").on("click", function () {
            var $copy = $(".form-body").clone().appendTo(document.body);
            $copy.find(".tools, :hidden").remove();
            $.each(["draggable", "droppable", "sortable", "dropped",
                "ui-sortable", "ui-draggable", "ui-droppable", "form-body"], function (i, c) {
                $copy.find("." + c).removeClass(c).removeAttr("style");
            })
            var html = html_beautify($copy.html());
            $copy.remove();

            $modal = get_modal(html).modal("show");
            $modal.find(".btn").remove();
            $modal.find(".modal-title").html("复制HTML代码");
            $modal.find(":input:first").select().focus();

            return false;
        })


    });

    var setup_draggable = function () {
        $(".draggable").draggable({
            appendTo: "body",
            helper: "clone"
        });
        $(".droppable").droppable({
            accept: ".draggable",
            helper: "clone",
            hoverClass: "droppable-active",
            drop: function (event, ui) {
                $(".empty-form").remove();
                var $orig = $(ui.draggable)
                if (!$(ui.draggable).hasClass("dropped")) {
                    var $el = $orig
                        .clone()
                        .addClass("dropped")
                        .css({
                            "position": "static",
                            "left": null,
                            "right": null
                        })
                        .appendTo(this);

                    // update id
                    var id = $orig.find(":input").attr("id");

                    if (id) {
                        id = id.split("-").slice(0, -1).join("-") + "-" + (parseInt(id.split("-").slice(-1)[0]) + 1)

                        $orig.find(":input").attr("id", id);
                        $orig.find("label").attr("for", id);
                    }

                    // tools
                    $('<p class="tools col-sm-12 col-sm-offset-3">\
						<a class="edit-link">编辑HTML<a> | \
						<a class="remove-link">移除</a></p>').appendTo($el);
                } else {
                    if ($(this)[0] != $orig.parent()[0]) {
                        var $el = $orig
                            .clone()
                            .css({
                                "position": "static",
                                "left": null,
                                "right": null
                            })
                            .appendTo(this);
                        $orig.remove();
                    }
                }
            }
        }).sortable();

    }

    var get_modal = function (content) {
        var modal = $('<div class="modal" style="overflow: auto;" tabindex="-1">\
			<div class="modal-dialog">\
				<div class="modal-content">\
					<div class="modal-header">\
						<a type="button" class="close"\
							data-dismiss="modal" aria-hidden="true">&times;</a>\
						<h4 class="modal-title">编辑HTML</h4>\
					</div>\
					<div class="modal-body ui-front">\
						<textarea class="form-control" \
							style="min-height: 200px; margin-bottom: 10px;\
							font-family: Monaco, Fixed">' + content + '</textarea>\
						<button class="btn btn-success">更新HTML</button>\
					</div>\
				</div>\
			</div>\
			</div>').appendTo(document.body);

        return modal;
    };

    $(document).on("click", ".edit-link", function (ev) {
        var $el = $(this).parent().parent();
        var $el_copy = $el.clone();

        var $edit_btn = $el_copy.find(".edit-link").parent().remove();

        var $modal = get_modal(html_beautify($el_copy.html())).modal("show");
        $modal.find(":input:first").focus();
        $modal.find(".btn-success").click(function (ev2) {
            var html = $modal.find("textarea").val();
            if (!html) {
                $el.remove();
            } else {
                $el.html(html);
                $edit_btn.appendTo($el);
            }
            $modal.modal("hide");
            return false;
        })
    });

    $(document).on("click", ".remove-link", function (ev) {
        $(this).parent().parent().remove();
    });
</script>



</body>

</html>
