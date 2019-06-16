<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_admin_role extends Model
{

    //
    protected $table = 'role';
    public function role_rbac()
    {
        return $this->hasMany('App\Shop_admin_role_rbac', 'role_id','id');
    }


}
