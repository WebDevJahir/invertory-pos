<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Perchase
 * @package App\Models
 * @version November 3, 2020, 8:01 am UTC
 *
 * @property integer $supplier_id
 * @property integer $unit_id
 * @property integer $category_id
 * @property integer $product_id
 * @property string $purchase_no
 * @property string $date
 * @property string $description
 * @property number $buying_qty
 * @property number $unit_price
 * @property number $buying_price
 * @property boolean $status
 */
class Perchase extends Model
{
    use SoftDeletes;

    public $table = 'purchases';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'supplier_id',
        'category_id',
        'product_id',
        'purchase_no',
        'date',
        'description',
        'buying_qty',
        'unit_price',
        'buying_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'supplier_id' => '',
        'category_id' => '',
        'product_id' => '',
        'purchase_no' => '',
        'date' => '',
        'description' => '',
        'buying_qty' => '',
        'unit_price' => '',
        'buying_price' => 'flot'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'supplier_id' => 'required',
        'category_id' => 'required',
        'product_id' => 'required',
        'purchase_no' => 'required|max:255',
        'date' => 'required',
        'description' => 'required|max:255',
        'buying_qty' => 'required',
        'unit_price' => 'required',
        'buying_price' => 'required',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }


    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    
}
