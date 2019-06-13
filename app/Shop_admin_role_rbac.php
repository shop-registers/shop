<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Shop_admin_role_rbac extends Model
{
    //
    protected $table = 'shop_admin_role_rbac';

    public function rbac()
    {
        return $this->hasOne('App\Shop_admin_rbac', 'id', 'rbac_id');
    }
}
