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

    public static function findByCategoryName($categoryId, $name)
    {
        return SubCategory::where('category_id', $categoryId)
                          ->where('name', $name)
                          ->first();
    }

    public static function store($categoryId, $name)
    {
        return SubCategory::create([
            'category_id' => $categoryId,
            'name' => $name,
        ]);
    }

    public static function getSubcategoryByIds($ids) {
        return SubCategory::whereIn('id', $ids)->whereNotNull('name')->get();
    }
}
