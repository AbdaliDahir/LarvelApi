<?php

namespace App;

use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    public $transformer = CategoryTransformer::class;

	use softDeletes;

	protected $dates = ['deleted_at'];

    protected $hidden = [
        'pivot'
    ];

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
