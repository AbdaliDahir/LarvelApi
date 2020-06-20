<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
    public function transform(User $user)
    {
        return [
            'id' => (int)$user->id,
            'username' => (string)$user->name,
            'email' => (string)$user->email,
            'verification' => (int)$user->verified,
            'user_status' => ($user->admin === "true"),
            'date_creation' =>  (string)$user->created_at,
            'last_update' => (string)$user->updated_at,
            'deleted_at' => isset($user->deleted_at) ? (string)$user->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $user->id),
                ],
            ]
        ];
    }

    public static function originalTransform($index) {
        $attributes = [
            'id' => 'id',
            'username' => 'name',
            'email' => 'email',
            'password' => 'password',
            'verification' => 'verified',
            'user_status' => 'admin',
            'date_creation' => 'created_at',
            'last_update' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function TransformedAttribute($index) {
        $attributes = [
            'id' => 'id',
            'name' => 'username',
            'email' => 'email',
            'password' => 'password',
            'verified' => 'verification',
            'admin' => 'user_status',
            'created_at' => 'date_creation',
            'updated_at' => 'last_update',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
