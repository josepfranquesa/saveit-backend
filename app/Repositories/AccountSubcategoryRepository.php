<?php

namespace App\Repositories;

use App\Models\AccountSubcategory;

class AccountSubcategoryRepository
{


    public static function find($accountId, $categoryId, $subcategoryId)
    {
        return AccountSubcategory::where('account_id', $accountId)
                                 ->where('category_id', $categoryId)
                                 ->where('subcategory_id', $subcategoryId)
                                 ->first();
    }

    public static function store($accountId, $categoryId, $subcategoryId){
        return AccountSubcategory::create([
            'account_id' => $accountId,
            'category_id' => $categoryId,
            'subcategory_id' => $subcategoryId,
        ]);
    }

    public static function getCategoryByAccountId($accountId)
    {
        return AccountSubcategory::where('account_id', $accountId)->pluck('category_id')->toArray();
    }
}
