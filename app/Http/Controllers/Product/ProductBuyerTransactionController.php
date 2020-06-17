<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        //rules
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

        if($buyer->id == $product->seller_id) {
            return $this->errorResponse('buyer and seller has some id', 409);
        }

        if(!$buyer->isVerified()) {
            return $this->errorResponse('buyer must be a verified User', 409);
        }

        if(!$product->seller->isVerified()) {
            return $this->errorResponse('Seller is not verified Yet', 409);
        }   

        //check product availability
        if(!$product->isAvailable()) {
            return $this->errorResponse('This product is not Available', 409);
        }

        //check for quantity
        if($product->quantity < $request->quantity ) {
            return $this->errorResponse('This product have not enough units for this transaction', 409);
        }

        return DB::Transaction(function() use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            return $this->showOne($transaction);
        });
    }   

}
