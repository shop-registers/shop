<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'brand';

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['id','brand_name','brand_logo','brand_order','is_show'];
}
