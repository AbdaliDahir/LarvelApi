<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
    	'quantity',
    	'buyer_id', //ForeignKey To Buyer
    	'product_id', //ForeignKey To Product
    ];

    // Relation TRansaction/Buyer
    public function buyer() {
    	return $this->belongsTo(Buyer::class);
    }

    // Relation TRansaction/Buyer
    public function product() {
    	return $this->belongsTo(Product::class);
    }
}
