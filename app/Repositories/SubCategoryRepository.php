<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\Objective;
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

    public static function findNameByCatSubcatId($id) {
        $subcategory = SubCategory::find($id);
        if ($subcategory->name != null) {
            return $subcategory->name;
        } else {
            return Category::find($subcategory->category_id)->name;
        }
    }

    public static function getSubcategoryByIds($ids) {
        return SubCategory::whereIn('id', $ids)->whereNotNull('name')->get();
    }

    public static function getSubcategoryByIdsWithNull($ids) {
        return SubCategory::whereIn('id', $ids)->get();
    }

    public static function checkLimit($subcategory_id, $amount){
        $limit = ObjectiveRepository::findById($subcategory_id);
        if($limit == null){
            return [
                'message' => 'No existe un limite para esta categoria/subcategoria',
            ];
        }
        else{
            $limit->amount += $amount;
            $limit->save();
            if($limit->amount > $limit->total){
                return [
                    'limite' => $limit,
                    'message' => 'Has superado el limite en la categoria/subcategoria'. $limit->name,
                ];
            }
        }

    }
}
