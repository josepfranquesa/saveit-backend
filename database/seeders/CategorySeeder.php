<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['type' => 'INGRESOS', 'name' => 'Salario'],
            ['type' => 'INGRESOS', 'name' => 'Inversiones'],
            ['type' => 'DESPESA', 'name' => 'Alimentación'],
            ['type' => 'DESPESA', 'name' => 'Transporte'],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);
            SubCategory::create([
                'category_id' => $category->id,
                'name' => "General " . $category->name
            ]);
        }
    }
}
