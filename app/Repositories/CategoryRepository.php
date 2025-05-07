<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\Register;
use Carbon\Carbon;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Collection;

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

    public static function getBalances(Collection $categories, int $account_id)
    {
        $start = Carbon::now()->startOfMonth()->toDateTimeString();
        $end   = Carbon::now()->endOfMonth()->toDateTimeString();

        foreach ($categories as $category) {
            $total = Register::join('subcategories as sc', 'registers.subcategory_id', '=', 'sc.id')
                ->where('sc.category_id',     $category->id)
                ->where('registers.account_id', $account_id)
                // ->whereBetween('registers.created_at', [$start, $end])
                ->sum('registers.amount');

            $category->amount_month = (float) $total;
        }

        return $categories;
    }

}
