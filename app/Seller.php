<?php

namespace App;

class Seller extends User
{
    //relation Seller Product
    public function products() {
    	return $this->hasMany(Product::class);
    }
}
