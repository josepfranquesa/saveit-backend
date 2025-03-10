<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Opcional si sigue la convención de nombres
    protected $fillable = ['type', 'name'];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function isExpenseCategory()
    {
        return $this->type === 'DESPESA';
    }

    public function isIncomeCategory()
    {
        return $this->type === 'INGRES';
    }
}

