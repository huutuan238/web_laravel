<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'tbl_category_product';
    protected $primarykey = 'category_id';
    public $timestamps = false;
    protected $fillable = ['category_name','category_desc','category_status'];
}
