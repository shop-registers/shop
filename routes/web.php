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
//后台首页
Route::get('/index',"MyController@index");
Route::get("/index_v1","MyController@index_v1");
//公共类
Route::get("/common","CommonController@initialize");
//添加菜单
Route::get("/add_menu","MenuController@add_menu");

