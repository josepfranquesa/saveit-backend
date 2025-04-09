<?php
namespace App\Repositories;

use App\Models\SubCategory;

class SubCategoryRepository
{
    public function getAll()
    {
        return SubCategory::with('category')->get();
    }

    public function create(array $data)
    {
        return SubCategory::create($data);
    }

    public static function find($id)
    {
        return SubCategory::find($id);
    }

    public static function store($categoryId, $name)
    {
        return SubCategory::create([
            'category_id' => $categoryId,
            'name' => $name,
        ]);
    }
}
