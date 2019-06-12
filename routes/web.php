<?php

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
Route::get('/', "GoodsTypeController@index");
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




