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
                    <h5>添加订单</h5>
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
                            <label class="col-sm-3 control-label">用户名：</label>
                            <div class="col-sm-9">
                                <input type="text" name="customer_name" class="customer_name" placeholder="请输入用户名">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">收货人：</label>
                            <div class="col-sm-9">
                                <input type="text" class="shipping_user" name="shipping_user" placeholder="请输入收货人">
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">手机号：</label>
                            <div class="col-sm-9">
                                <input type="text" class="shipping_tel" name="shipping_tel" placeholder="请输入收货人手机号">
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">地址：</label>
                            <div class="col-sm-9">
                                省:
                                <select class="area_name" name="area_name">
                                    <option value="">请选择</option>
                                    @foreach($data as $v)
                                    <option value="{{$v['area_name']}}" >{{$v['area_name']}}</option>
                                    @endforeach
                                </select>
                                区:
                                <select class="one" name="one">
                                    <option value="">请选择</option>

                                        <option value=""></option>

                                </select>

                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">详细地址：</label>
                            <div class="col-sm-9">
                                <input type="text" class="address" name="address" placeholder="请输入详细地址">
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">订单金额：</label>
                            <div class="col-sm-9">
                                <input type="text" class="order_money" name="order_money" placeholder="请输入订单金额">
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">优惠金额：</label>
                            <div class="col-sm-9">
                                <input type="text" class="district_money" name="district_money" placeholder="请输入优惠金额">
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">运费金额：</label>
                            <div class="col-sm-9">
                                <input type="text" class="shipping_money" name="shipping_money" placeholder="请输入运费金额">
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">快递公司名称 : </label>
                            <div class="col-sm-9">
                                <input type="text" class="shipping_comp_name" name="shipping_comp_name" placeholder="请输入快递公司名称">
                            </div>
                        </div>


                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">支付方式：
                            </label>

                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" checked="" value="1" id="optionsRadios1" name="payment_method"  class="payment_method">货到付款</label>
                                <label class="radio-inline">
                                    <input type="radio" value="2" id="optionsRadios2" name="payment_method" class="payment_method">支付宝</label>
                                <label class="radio-inline">
                                    <input type="radio" value="3" id="optionsRadios2" name="payment_method" class="payment_method">微信</label>
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
        var customer_name = $('.customer_name').val();
        var shipping_user = $('.shipping_user').val();
        var shipping_tel = $('.shipping_tel').val();
        var area_name = $('.area_name').val();
        var city = $('.one').val();
        var address = $('.address').val();
        var order_money = $('.order_money').val();
        var payment_method = $('input:radio[name="payment_method"]:checked').val();
        var shipping_comp_name = $('.shipping_comp_name').val();
        var district_money = $('.district_money').val();
        var shipping_money = $('.shipping_money').val();
        
        


        $.ajax({
            url:"/orderAdds",
            data:{
                customer_name:customer_name,shipping_user:shipping_user,
                shipping_tel:shipping_tel,area_name:area_name,city:city,
                address:address,order_money:order_money,payment_method:payment_method,
                shipping_comp_name:shipping_comp_name,district_money:district_money,
                shipping_money:shipping_money,
                },
            type:"post",
            dataType:"json",

            success:function(res){
                if(res == 1)
                {
                    alert('添加成功');
                    location.href = "orderlist";
                }
                else
                {
                    alert('添加失败');
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
