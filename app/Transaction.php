<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use softDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'quantity',
    	'buyer_id', //ForeignKey To Buyer
    	'product_id', //ForeignKey To Product
    ];

    // Relation Transaction/Buyer
    public function buyer() {
    	return $this->belongsTo(Buyer::class);
    }

    // Relation TRansaction/Buyer
    public function product() {
    	return $this->belongsTo(Product::class);
    }
}
