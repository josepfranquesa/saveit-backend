<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\AccountSubcategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::with('subcategories')->get());
    }


    //[
    //    "id_category": 1,
    //    "name_category": "cotxe",
    //    "type_category": "INGRESO/DESPESA",
    //
    //    "id_subcat": 10,
    //    "name_subcat": "gasolina",
    //
    //
    //]

    public function store(Request $request)
    {
        //    "account_id": 1,
        //    "id_category": 1, //si lestic creant no n'hi haura
        //    "name_category": "cotxe",
        //    "type_category": "INGRESO/DESPESA",

        //    "id_subcat": null,
        //    "name_subcat": "null",

        $category = CategoryRepository::findByNameType($request->name_category, $request->type_category);
        $account_category_subcategory = AccountSubcategoryRepository::find($request->account_id, $request->id_category, null);
        if(!$account_category_subcategory){
            if(!$category ){
                $category = CategoryRepository::store($request->name_category, $request->type_category);
                $subcategory = SubCategoryRepository::store($category->id, null); //subcategoria null, que es la relacio entre registre i categoria
                $account_category_subcategory = AccountSubcategoryRepository::store($request->account_id, $category->id, $subcategory->id);

            }
            else return response()->json(['category' => $category, 'message' => 'Categoria creada para esta cuenta']);
        }
        else return response()->json(['category' => $category, 'message' => 'Ya existe esta categoria para esta cuenta']);


        // if($request->id_subcat){
        //     $subcategory = SubCategoryRepository::find($request->id_subcat);
        //     if(!$subcategory){
        //         $subcategory = SubCategoryRepository::store($request->id_category, $request->name_subcat);
        //     }
        // }
        // else{
        //     $category = CategoryRepository::store($request->name_category, $request->type_category);
        // }



        // //si la categoria ya existe se

        // //hay dos tipos de subcategorias las que tienen un id de categoria y las que no
        // //no tiene categorya se tiene que crear una nueva subcategoria con el request->id request->name_subcat
        // //si tiene categoria se tiene que crear una nueva categoria con el request->id request->name_subcat request->category_id
        // //    tambien tendra que crear la nueva categoria con el request->category_id request->name_bcat request->type



        // return response()->json($category, 201);
    }
}
