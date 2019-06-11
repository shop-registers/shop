<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    public $table="goods";
    public function add($data){
    	unset($data['_token']);
    }
}
