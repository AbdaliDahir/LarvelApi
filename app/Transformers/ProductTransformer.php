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
            'description' => (string)$product->description,
            'stock' => (int)$product->quantity,
            'status' => $product->status,
            'image' => url("img/{$product->image}"),
            'seller' => $product->seller_id,
            'date_creation' => (string)$product->created_at,
            'last_update' => (string)$product->updated_at,
            'deleted_at' => isset($product->deleted_at) ? (string)$product->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $product->id),
                ],
                [
                    'rel' => 'product.categories',
                    'href' => route('products.categories.index', $product->id),
                ],
                [
                    'rel' => 'product.buyers',
                    'href' => route('products.buyers.index', $product->id),
                ],
                [
                    'rel' => 'product.transactions',
                    'href' => route('products.transactions.index', $product->id),
                ],
                [
                    'rel' => 'seller',
                    'href' => route('sellers.show', $product->seller_id),
                ],
            ]
        ];
    }

    public static function originalTransform($index) {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'description' => 'description',
            'stock' => 'quantity',
            'status' => 'status',
            'image' => 'image',
            'seller' => 'seller_id',
            'date_creation' => 'created_at',
            'last_update' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function TransformedAttribute($index) {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'description' => 'description',
            'quantity' => 'stock',
            'status' => 'status',
            'image' => 'image',
            'seller_id' => 'seller',
            'created_at' => 'date_creation',
            'updated_at' => 'last_update',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
