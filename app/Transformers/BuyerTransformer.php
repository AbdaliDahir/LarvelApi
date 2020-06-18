<?php

namespace App\Transformers;

use App\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer)
    {
        return [
            'id' => (int)$buyer->id,
            'username' => (string)$buyer->name,
            'email' => (string)$buyer->email,
            'verification' => (int)$buyer->verified,
            'date_creation' => (string)$buyer->created_at,
            'lest_update' => (string)$buyer->updated_at,
            'deleted_at' => isset($buyer->deleted_at) ? (string)$buyer->deleted_at : null,
        ];
    }

    public static function originalTransform($index) {
        $attributes = [
            'id' => 'id',
            'username' => 'name',
            'email' => 'email',
            'verification' => 'verified',
            'date_creation' => 'created_at',
            'last_update' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

}
