<?php

namespace App;

class Buyer extends User
{
    //Relation Betwen Buyer and Transaction
    public function transactions() {
    	// Buyer has many transactions
    	return $this->hasMany(Transaction::class);
    }
}
