<?php

namespace App;

use App\Scopes\BuyerScope;
use App\Transaction;

class Buyer extends User
{
	//redefined boot method -- its executed when extance of this method created
	protected static function booted() {
		//call boot method of the parent class -- important to edit behavior
		// parent::boot();

		static::addGlobalScope(new BuyerScope);
	}

    //Relation Betwen Buyer and Transaction
    public function transactions() {
    	// Buyer has many transactions
    	return $this->hasMany(Transaction::class);
    }
}
