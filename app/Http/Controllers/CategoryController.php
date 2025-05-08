<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\SubCategoryController;
use App\Repositories\AccountSubcategoryRepository;
use App\Repositories\RegisterRepository;
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
        $category = CategoryRepository::findByNameType($request->name_category, $request->type_category);
        if (!$category) $category = CategoryRepository::store($request->name_category, $request->type_category);

        $subcategory = SubCategoryRepository::findByCategoryName($category->id, null);
        if (!$subcategory) $subcategory = SubCategoryController::initSubcategory($category->id, null);

        $account_category_subcategory = AccountSubcategoryRepository::find($request->account_id, $category->id, $subcategory->id);
        if (!$account_category_subcategory) $account_category_subcategory = AccountSubcategoryRepository::store($request->account_id, $category->id, $subcategory->id);

        return response()->json(['category' => $category, 'message' => 'Categoria creada para esta cuenta']);
    }

    public function getCategoryForAccount(int $account_id)
    {
        $categoryIds = AccountSubcategoryRepository::getCategoryByAccountId($account_id);
        $categories = CategoryRepository::getCategoyByIds($categoryIds);
        $categoriesWithBalance = CategoryRepository::getBalances($categories, $account_id);
        return response()->json($categoriesWithBalance);
    }

    public function destroyCategoryAccount($id_cat, $accountId){
        $id_subCat_Null = SubCategoryRepository::findByCategoryId($id_cat)->id;
        $registeres = RegisterRepository::findByAcountSubcategory($id_subCat_Null, $accountId);
        foreach ($registeres as $register){
            $register->subcategory_id = null;
            $register->save();
        }
        $subcategoriesIds  = AccountSubcategoryRepository::getSubcategoriesByCategoryIdAndAccountId($id_cat, $accountId);
        $subcategories = SubCategoryRepository::getSubcategoryByIds($subcategoriesIds);
        foreach ($subcategories as $subcategory){
            SubCategoryController::destroySubcategoryAccount($subcategory->id, $accountId);
        }
        $accountCat = AccountSubcategoryRepository::findSubcatAccount($accountId, $id_subCat_Null);
        if ($accountCat){
            $accountCat->delete();
            return response()->json(['message' => 'Categoria eliminada para esta cuenta']);
        } else {
            return response()->json(['message' => 'No se ha podido eliminar la categoria para esta cuenta']);
        }
    }

}
