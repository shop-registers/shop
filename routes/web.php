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