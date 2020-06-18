<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [ 
            'id' => (int)$product->id,
            'name' => (string)$product->name,
            'description' => (string)$product->email,
            'stock' => (int)$product->quantity,
            'status' => $product->status,
            'image' => url("img/{$product->image}"),
            'seller' => $product->seller_id,
            'date_creation' => (string)$product->created_at,
            'last_update' => (string)$product->updated_at,
            'deleted_at' => isset($product->deleted_at) ? (string)$product->deleted_at : null,
        ];
    }
}
