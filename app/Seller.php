<?php

namespace App;

use App\Product;
use App\Scopes\SellerScope;

class Seller extends User
{
	protected static function booted() {
		// parent::boot();
		static::addGlobalScope(new SellerScope);
	}
    //relation Seller Product
    public function products() {
    	return $this->hasMany(Product::class);
    }
}
