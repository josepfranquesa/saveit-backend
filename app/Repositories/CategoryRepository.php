<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::with('subcategories')->get();
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
