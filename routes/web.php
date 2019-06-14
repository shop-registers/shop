<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 登录
Route::get('/',"MyController@login");
//商品分类路由
Route::group(['prefix'=>'/'],function(){
    Route::get('goodstype', "GoodsTypeController@goodsTypeList");
    Route::get('destory/{id?}', "GoodsTypeController@destory");
    Route::get('edit/{id?}', "GoodsTypeController@edit");
    Route::get('create', "GoodsTypeController@create");
    Route::post('createdo', "GoodsTypeController@createdo");
    Route::post('edit/save', "GoodsTypeController@save");
});
//商品品牌路由
Route::group(['prefix'=>'/'],function(){
    Route::any('brandlist', "GoodsBrandController@brandlist");
    Route::get('brandcreate', "GoodsBrandController@brandcreate");
    Route::post('brandcreatedo', "GoodsBrandController@brandcreatedo");
    Route::get('branddestory/{id?}', "GoodsBrandController@branddestory");
    Route::get('brandedit/{id?}', "GoodsBrandController@brandedit");
    Route::any('brandedit/brandsave', "GoodsBrandController@brandsave");
});

//客服路由
Route::group(['prefix'=>'/'],function(){
    Route::get('customerlist','CustomerConteoller@customerlist');
    Route::get('comment/{id?}','CustomerConteoller@comment');
    Route::any('commentadd','CustomerConteoller@commentadd');
    Route::any('commentdelete/{id?}','CustomerConteoller@commentdelete');
});


Route::post('/login_do',"MyController@login_do");
//后台首页
Route::get('/index',"MyController@index");
Route::get("/index_v1","MyController@index_v1");
//公共类
Route::get("/common","CommonController@initialize");



Route::get('/uploads', function(){
	return view('admin/uploads');
});


/**
 * 商品属性模块
 */
Route::group(['prefix'=>'/attr'],function(){
	Route::get('/list','GoodsController@Attr_list');//商品属性的列表
	Route::get('/attr_del','GoodsController@Attr_delete');//商品属性的删除
	Route::any('/add','GoodsController@Attr_add');//商品属性的添加与入库
	Route::get('/add_attr', function(Request $request){
		$id=$request->input('id');
		$type = DB::table('good_attr')->get();
		return view('attr/attr_once',['id'=>$id,'type'=>$type]);
	});//添加属性值页面
	Route::get('/attr_upd',function(Request $request){
		$id=$request->input('id');
		$attr = DB::table('good_attr')->where('id',$id)->get();
		$type = DB::table('goods')->get();
		return view('attr/attr_up',['attr'=>$attr[0],'type'=>$type,'id'=>$id]);
	});//修改属性页面
	Route::get('/changegood','GoodsController@Change_good');//ajax分类改变商品
	Route::post('/up_once','GoodsController@updata_once');//添加一个属性值入库
	
	
});

/**
 * 商品模块
 */
Route::group(['prefix'=>'/goods'],function(){
	Route::get('/list','GoodsController@Good_list');//展示商品列表
	Route::get('/changeattr','GoodsController@Change_attr');//ajax改变商品属性
	Route::get('/changegood','GoodsController@Change_good');//ajax改变商品
	Route::get('/changebrand','GoodsController@Change_brand');//ajax改变品牌
	Route::any('/addsku','GoodsController@Show_sku');//展示添加sku的页面与sku入库
	Route::get('/allsku','GoodsController@CartesianProduct');//一键生成sku
	Route::get('/delete_img/{goods_id}/{id}','GoodsController@delete_img');//删除副图
	Route::get('/imglist','GoodsController@Good_imglist');//商品主图与副图的展示
	Route::get('/auxiliary_img/{id}',function($id){
		$res=DB::table('goods_img')->where('goods_id',$id)->get();
		return view('goods/uploads_auxiliary',['id'=>$id,'info'=>$res]);
	});//展示副图添加页面
	Route::get('/good_del','GoodsController@Good_delete');//商品删除
	Route::post('/multiUploadImg','GoodsController@multiUploadImg');//ajax上传图片
	Route::any('/add','GoodsController@Good_add');//商品的添加与展示
	Route::any('/good_upd','GoodsController@Good_updata');//商品的修改页面与修改入库
	
});
//添加角色
Route::get('/add_role', 'Role@add_role');
//管理员角色列表
Route::get('/show_role', 'Role@show_role');
//管理员角色修改
Route::get('/upd_role/{id}', 'Role@upd_role');
//管理员删除角色
Route::get('/del_role', 'Role@del_role');
//管理员角色修改数据
Route::post('/upd_roles/', 'Role@upd_roles');
//获取权限id
Route::get('/get_rbac_id/{id}', 'Role@upd_role');
//添加管理员
Route::get('/add_admin', 'Admin@add_admin');
//删除管理员
Route::get('/admin_del', 'Admin@admin_del');
//列表展示管理员
Route::get('/show_admin', 'Admin@show_admin');
//添加表单
Route::get('/haha', 'Admin@haha');
//修改表单
Route::get('/upd_admin/{id}', 'Admin@upd_admin');
//修改表单
Route::get('/upd', 'Admin@upd');
//添加角色
Route::post('/add_roles', 'Role@add_roles');
