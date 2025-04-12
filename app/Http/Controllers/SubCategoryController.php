<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Repositories\SubCategoryRepository;
use App\Repositories\AccountSubcategoryRepository;

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

        //    "id_subcat": 10,
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

    public function getSubcategoryForCategoryAccount($category_id, $account_id){
        $subcategoriesIds = AccountSubcategoryRepository::getSubcategoryByCategoryIdAndAccountId($category_id, $account_id);
        $subcategories = SubcategoryRepository::getSubcategoryByIds($subcategoriesIds);
        return response()->json($subcategories);
    }
}
