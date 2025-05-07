<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'type'];
    public    $timestamps = true;

    protected $appends = ['amount_month'];

    protected $casts = ['amount_month' => 'float'];

    public function getAmountMonthAttribute()
    {
        return $this->attributes['amount_month'] ?? 0.0;
    }

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
