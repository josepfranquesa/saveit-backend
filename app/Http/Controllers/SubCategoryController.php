<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Repositories\AccountSubcategoryRepository;
use App\Repositories\SubCategoryRepository;

class SubCategoryController extends Controller
{
    public function index()
    {
        return response()->json(SubCategory::with('category')->get());
    }

    public function store(Request $request)
    {
         //    "account_id": 1,
        //    "id_category": 1,

        //    "id_subcat": 10,
        //    "name_subcat": "gaolina",
        $subcategory = SubCategoryRepository::find($request->id_subcat);
        $account_subcategory = AccountSubcategoryRepository::find($request->account_id, $request->id_subcat);
        if(!$account_subcategory){
            $account_subcategory = AccountSubcategoryRepository::store($request->account_id, $request->id_subcat);
            if(!$subcategory){
                $subcategory = SubCategoryRepository::store($request->id_category, $request->name_subcat);
            }
            else return response()->json(['subcategory' => $subcategory, 'message' => 'Subcategoria creada para esta cuenta']);
        }
        else return response()->json(['subcategory' => $subcategory, 'message' => 'Ya existe esta subcategoria para esta cuenta']);
    }
}
