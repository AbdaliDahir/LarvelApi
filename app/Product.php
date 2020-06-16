<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use softDeletes;
    protected $dates = ['deleted_at'];
    
	const AVAILABLE_PRODUCT = 'available';
	const UNAVAILABLE_PRODUCT = 'unavailable';
    //
    protected $fillable = [
    	'name',
    	'description', 
    	'quantity', 
    	'status',
    	'image',
    	'seller_id',
    ];

    public function isAvailable() {
    	return $this->status == Product::AVAILABLE_PRODUCT;
    }

    // Relation Between Seller and Product
    public function seller() {
    	return $this->belongsTo(Seller::class);
    }

    //Relation Between Product and Transaction
    public function transactions() {
    	return $this->hasMany(Transaction::class);
    }

    //Relation between Categories and Product
    public function categories() {
    	// Many To Many Relation 
    	return $this->belongsToMany(Category::class);
    }
}
