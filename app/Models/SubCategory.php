<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = ['category_id', 'name'];

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
