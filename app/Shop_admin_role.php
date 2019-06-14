<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_admin_role extends Model
{

    //
    protected $table = 'shop_admin_role';
    public function role_rbac()
    {
        return $this->hasMany('App\Shop_admin_role_rbac', 'role_id','id');
    }

//foreach ($a as $val) {
//foreach ($val->role_rbac() as $val2) {
//
//}
//}



}
