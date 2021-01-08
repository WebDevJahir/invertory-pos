<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
	public function category(){
		return $this->hasOne(Category::class,'id','category_id');
	}
	public function product(){
        return $this->hasOne(Product::class, 'id','product_id');
    }
}
