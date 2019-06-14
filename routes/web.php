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

//仓库添加
Route::any('/WarehouseAdd','WarehouseController@WarehouseAdd');

Route::any('/WarehouseAdds','WarehouseController@WarehouseAdds');

Route::any('/WarehouseShow','WarehouseController@WarehouseShow');