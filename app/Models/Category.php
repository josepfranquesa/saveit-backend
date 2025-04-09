<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'type'];

    // Para indicar que la tabla usa timestamps, se deja por defecto en true
    public $timestamps = true;

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
        return $this->type === 'INGRESO';
    }
}
