<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public static $rules = [
        'invoice_no' => 'required',
        'date' => 'required',
        'description' => 'required|string',
        'status' => 'nullable',
        'created_by' => 'nullable|integer',
        'approved_by' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
    public function payment(){
        return $this->belongsTo(Payment::class,'id','invoice_id');
    }


    public function invoice_details(){
        return $this->hasMany(InvoiceDetail::class, 'invoice_id','id');
    }
    
}
