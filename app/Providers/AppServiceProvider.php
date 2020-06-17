<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //Update Product Status
        Product::updated(function($product) {
            if($product->quantity == 0 && $product->isAvailable()) {
                $product->status = Product::UNAVAILABLE_PRODUCT;

                $product->save();
            }
        });

        //event to send user Email when account created
        User::created(function($user) {
            // work with "seed" to send email just for not verified users
            if(!$user->isVerified()) {
                // to($user->email) -- laravel get email automaticly
                retry(5, function() use($user) { 
                    Mail::to($user)->send(new UserCreated($user));
                }, 1000);
            }
            
        });

        //check when email updated
        User::updated(function($user) {
            // isDirty to check if email was changed
            if($user->isDirty('email')) {
                retry(5, function() use($user) { 
                    Mail::to($user)->send(new UserMailChanged($user));
                }, 1000);
            }
            
        });
    }
}
