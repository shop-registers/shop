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

Route::get('/', function () {
    return view('welcome');
});

//订单列表
Route::get('/orderlist','orderController@orderlist');
Route::get('/index','orderController@index');
//订单编辑
Route::any('/orderAdd','orderController@orderAdd');
//订单添加
Route::post('/orderAdds','orderController@orderAdds');
//订单修改
Route::any('/orderUpdate','orderController@orderUpdate');

//仓库添加首页
Route::any('/WarehouseAdd','WarehouseController@WarehouseAdd');
//仓库添加
Route::any('/WarehouseAdds','WarehouseController@WarehouseAdds');
//仓库展示
Route::any('/WarehouseShow','WarehouseController@WarehouseShow');
//仓库删除
Route::any('/WarehouseDel','WarehouseController@WarehouseDel');
//仓库修改
Route::any('/WarehouseUpdate','WarehouseController@WarehouseUpdate');
Route::any('/WarehouseUpdates','WarehouseController@WarehouseUpdates');