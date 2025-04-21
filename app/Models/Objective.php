<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $table = 'objectives';

    // Campos rellenables (mass assignment)
    protected $fillable = [
        'user_id',
        'account_id',
        'subcategory_id',
        'limit_name',
        'type',
        'amount',
        'total',
        'title',
    ];

    protected $casts = [
        'amount' => 'double',
    ];

    // Relación con User (cada objetivo pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con Account (cada objetivo pertenece a una cuenta)
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // Un objetivo puede (opcionalmente) pertenecer a una subcategoría
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // Un objetivo puede tener varios registros
    public function registers()
    {
        return $this->hasMany(Register::class);
    }
}
