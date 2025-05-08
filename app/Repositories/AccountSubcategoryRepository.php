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

    public static function getSubcategoryByAccountId($accountId){
        return AccountSubcategory::where('account_id', $accountId)->pluck('subcategory_id')->toArray();
    }

    public static function getSubcategoryByCategoryIdAndAccountId($categoryId, $accountId){
        return AccountSubcategory::where('category_id', $categoryId)->where('account_id', $accountId)->pluck('subcategory_id')->toArray();
    }

    public static function getSubcategoryDespesaByAccountId($account_id)
    {
        return AccountSubcategory::query()
            ->join('categories', 'account_category_subcategory.category_id', '=', 'categories.id')
            ->where('account_category_subcategory.account_id', $account_id)
            ->orderBy('account_category_subcategory.category_id')
            ->pluck('account_category_subcategory.subcategory_id')
            ->toArray();
    }

    public static function findSubcatAccount($accountId, $id_subCat){
        return AccountSubcategory::where('account_id', $accountId)->where('subcategory_id', $id_subCat)->first();
    }

    public static function findOtherSubcatAccounts($accountSubcat){
        return AccountSubcategory::where('category_id', $accountSubcat->category_id)->where('subcategory_id', $accountSubcat->subcategory_id)->where('account_id', '!=', $accountSubcat->account_id)->count();
    }

    public static function getSubcategoriesByCategoryIdAndAccountId($categoryId, $accountId){
        return AccountSubcategory::where('category_id', $categoryId)->where('account_id', $accountId)->pluck('subcategory_id')->toArray();
    }

}
