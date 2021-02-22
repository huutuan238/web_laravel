<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $fillable = [
    	'product_name','product_desc','product_content', 'product_price', 'product_image', 'product_status', 'category_id', 'brand_id'
    ];
}
