<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function author(User $user, Product $product){

        if($user->id == $product->user_id){
            return true;
        }

        return false;
    }
}
