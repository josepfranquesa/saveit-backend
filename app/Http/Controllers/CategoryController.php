<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\SubCategoryController;
use App\Repositories\AccountSubcategoryRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::with('subcategories')->get());
    }

    public function store(Request $request)
    {
        //    "account_id": 1,
        //    "id_category": 1, //si lestic creant no n'hi haura
        //    "name_category": "cotxe",
        //    "type_category": "INGRESO/DESPESA",

        //    "id_subcat": null,
        //    "name_subcat": "null",

        $category = CategoryRepository::findByNameType($request->name_category, $request->type_category);
        if(!$category ) $category = CategoryRepository::store($request->name_category, $request->type_category);

        $subcategory = SubCategoryRepository::findByCategoryName($category->id, null);
        if(!$subcategory) $subcategory = SubCategoryController::initSubcategory($category->id, null);

        $account_category_subcategory = AccountSubcategoryRepository::find($request->account_id, $request->id_category, null);
        if(!$account_category_subcategory) $account_category_subcategory = AccountSubcategoryRepository::store($request->account_id, $category->id, $subcategory->id);

        return response()->json(['category' => $category, 'message' => 'Categoria creada para esta cuenta']);

    }

    public function getCategoryForAccount($account_id){
        $categoriesIds = AccountSubcategoryRepository::getCategoryByAccountId($account_id);
        $category = CategoryRepository::getCategoyByIds($categoriesIds);
        return response()->json($category);

    }

}
