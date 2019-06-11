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

Route::get('/', 'Mycontroller@index');
Route::get('/uploads', function(){
	return view('admin/uploads');
});
Route::get('/index_v1', 'Mycontroller@index_v1');
Route::post('/submitimg', 'Mycontroller@fileget');


Route::group(['prefix'=>'/attr'],function(){
	Route::get('/list','GoodsController@Attr_list');
	Route::get('/add',function(){
		$type = DB::table('admin_goodstype')->get();
		return view('attr/add',['type'=>$type]);
	});
	Route::post('/submitattr', 'GoodsController@Attr_add');
	Route::get('/add_attr', function(Request $request){
		$id=$request->input('id');
		$type = DB::table('good_attr')->get();
		return view('attr/attr_once',['id'=>$id,'type'=>$type]);
	});
	Route::post('/up_once','GoodsController@updata_once');
	Route::get('/attr_upd',function(Request $request){
		$id=$request->input('id');
		$attr = DB::table('good_attr')->where('id',$id)->get();
		$type = DB::table('admin_goodstype')->get();
		return view('attr/attr_up',['attr'=>$attr[0],'type'=>$type]);
	});
	Route::get('/attr_del','GoodsController@Attr_delete');
});
Route::group(['prefix'=>'/goods'],function(){
	Route::get('/list','GoodsController@Good_list');
	Route::get('/changeattr','GoodsController@Change_attr');
	Route::get('/addsku',function(){
		$type = DB::table('admin_goodstype')->get();
		return view('goods/addsku',['type'=>$type]);
	});
	Route::get('/add',function(){
		$type = DB::table('admin_goodstype')->get();
		return view('goods/add',['type'=>$type]);
	});
	Route::get('/allsku','GoodsController@CartesianProduct');
	Route::post('/good_add','GoodsController@Good_add');

});