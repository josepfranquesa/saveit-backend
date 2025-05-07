<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = ['category_id', 'name'];

    protected $appends = ['amount_month'];

    protected $casts = ['amount_month' => 'float'];

    public function getAmountMonthAttribute()
    {
        return $this->attributes['amount_month'] ?? 0.0;
    }

    public function accounts()
    {
        return $this->belongsToMany(AccountSubcategory::class);
    }

    // Relación con Category (cada subcategoría pertenece a una categoría)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Una subcategoría puede (opcionalmente) tener un único objetivo
    public function objective()
    {
        return $this->hasOne(Objective::class);
    }

    // Una subcategoría puede tener muchos registros
    public function registers()
    {
        return $this->hasMany(Register::class);
    }
}
