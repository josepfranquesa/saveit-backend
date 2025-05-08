<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Repositories\SubCategoryRepository;
use App\Repositories\AccountSubcategoryRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\RegisterRepository;

class SubCategoryController extends Controller
{
    public function index()
    {
        return response()->json(SubCategory::with('category')->get());
    }

    public static function initSubcategory($categoryId, $nameSubcategory)
    {
        $subcategory = SubCategoryRepository::findByCategoryName($categoryId, $nameSubcategory);
        if(!$subcategory){
            $subcategory = SubCategoryRepository::store($categoryId, $nameSubcategory);
        }
        return $subcategory;
    }

    public function store(Request $request)
    {
        //    "account_id": 1,
        //    "id_category": 1,

        //    "name_subcat": "gaolina",
        $subcategory = SubCategoryRepository::findByCategoryName($request->id_category, $request->name_subcat);
        if(!$subcategory) $subcategory = SubCategoryRepository::store($request->id_category, $request->name_subcat);

        $account_category_subcategory = AccountSubcategoryRepository::find($request->account_id, $request->id_category, $subcategory->id);
        if(!$account_category_subcategory){
            $account_category_subcategory = AccountSubcategoryRepository::store($request->account_id, $request->id_category, $subcategory->id);
            return response()->json(['subcategory' => $subcategory, 'message' => 'Subcategoria creada para esta cuenta']);
        }
        else return response()->json(['subcategory' => $subcategory, 'message' => 'No se ha podido crear la subcategoria para esta cuenta']);

    }

    public function getSubcategoryForAccount($account_id)
    {
        $subcategoryIds = AccountSubcategoryRepository::getSubcategoryDespesaByAccountId($account_id);

        $subcategories = SubcategoryRepository::getSubcategoryByIdsWithNull($subcategoryIds);

        $categoryIds  = $subcategories->pluck('category_id')->unique()->all();
        $categories   = CategoryRepository::getCategoyByIds($categoryIds)->keyBy('id');

        $subcategories = $subcategories->map(function($sub) use ($categories) {
            if (is_null($sub->name) && isset($categories[$sub->category_id])) {
                $sub->name = $categories[$sub->category_id]->name;
            }
            $sub->category_type = $categories[$sub->category_id]->type ?? null;
            return $sub;
        });

        $subcategories = $subcategories->sortBy('category_id')->values();

        return response()->json($subcategories);
    }

    public function getSubcategoryForCategoryAccount($category_id, $account_id){
        $subcategoriesIds = AccountSubcategoryRepository::getSubcategoryByCategoryIdAndAccountId($category_id, $account_id);
        $subcategories = SubcategoryRepository::getSubcategoryByIds($subcategoriesIds);
        $subcategoriesWithBalance = SubcategoryRepository::getBalances($subcategories, $account_id);
        return response()->json($subcategoriesWithBalance);
    }

    public static function destroySubcategoryAccount($id_subCat, $accountId){
        $registeres = RegisterRepository::findByAcountSubcategory($id_subCat, $accountId);
        foreach ($registeres as $register){
            $register->subcategory_id = null;
            $register->save();
        }
        $accountSubcat = AccountSubcategoryRepository::findSubcatAccount($accountId, $id_subCat);
        if ($accountSubcat){
            $other_accountSubcat = AccountSubcategoryRepository::findOtherSubcatAccounts($accountSubcat);
            $accountSubcat->delete();
            if($other_accountSubcat == 0){
                SubCategoryRepository::find($id_subCat)->delete();
            }
            return response()->json(['message' => 'Subcategoria eliminada para esta cuenta']);
        } else {
            return response()->json(['message' => 'No se ha podido eliminar la subcategoria para esta cuenta']);
        }
    }

}
