<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::with('subcategories')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:INGRESOS,DESPESA',
            'name' => 'required|unique:categories,name',
        ]);

        $category = Category::create($request->all());

        return response()->json($category, 201);
    }
}
