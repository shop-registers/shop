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
//首页
Route::get('/index', 'Onlin_retailers@index');
//添加角色
Route::get('/add_role', 'Role@add_role');
//管理员角色列表
Route::get('/show_role', 'Role@show_role');
//添加管理员
Route::get('/add_admin', 'Admin@add_admin');
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