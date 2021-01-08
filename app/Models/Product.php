<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version November 3, 2020, 5:20 am UTC
 *
 * @property integer $supplier_id
 * @property integer $unit_id
 * @property integer $category_id
 * @property integer $product_name
 * @property integer $quantity
 * @property boolean $status
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'supplier_id',
        'unit_id',
        'category_id',
        'product_name',
        'quantity',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'supplier_id' => 'integer',
        'unit_id' => 'integer',
        'category_id' => 'integer',
        'product_name' => 'string',
        'quantity' => 'integer',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'supplier_id' => 'required|integer',
        'unit_id' => 'required|integer',
        'category_id' => 'required|integer',
        'product_name' => 'required|string',
        'quantity' => 'required|integer',
        'status' => 'required|boolean',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class,'subblier_id','id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function perchase(){
        return $this->belongsTo(Perchase::class,'product_id','id');
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class,'product_id','id');
    }

    
}
