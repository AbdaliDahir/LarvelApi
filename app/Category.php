<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use softDeletes;

	protected $dates = ['deleted_at'];

    //
    protected $fillable = [
    	'name',
    	'description',
    ];

    public function products() {
    	//ManyTOMany relation
    	return $this->belongsTOMany(Product::class);
    }
}
