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

// 登录
Route::get('/',"MyController@login");
Route::post('/login_do',"MyController@login_do");
Route::post('/reset_password',"MyController@reset_password");
//后台首页
Route::get('/index',"MyController@index");
Route::get("/index_v1","MyController@index_v1");
//公共类
Route::get("/common","CommonController@initialize");
//验证滑动token
Route::post("/check_token","MyController@check_token");
//添加菜单
Route::any("/add_menu","MenuController@add_menu");
//菜单列表
Route::get("/menu_list","MenuController@menu_list");
//查看子菜单
Route::post("/submenu_list","MenuController@submenu_list");
//删除菜单
Route::post("/del_menu","MenuController@del_menu");
//编辑菜单
Route::any("/update_menu","MenuController@update_menu");
Route::any("/update_menu1","MenuController@update_menu1");
Route::any("/update_menu2","MenuController@update_menu2");

