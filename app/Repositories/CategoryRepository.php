<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::with('subcategories')->get();
    }

    public static function getCategoyByIds($categoriesIds){
        return Category::whereIn('id', $categoriesIds)->get();
    }

    public static function getCategoyDespesaByIds($categoriesIds){
        return Category::whereIn('id', $categoriesIds)->where('type', 'Despesa')->get();
    }

    public static function findByNameType($name_category, $type_category) {
        return Category::whereRaw('LOWER(name) = ?', [strtolower($name_category)])
                       ->where('type', $type_category)
                       ->first();
    }

    public static function store($name, $type)
    {
        return Category::create([
            'name' => $name,
            'type' => $type,
        ]);
    }
}
