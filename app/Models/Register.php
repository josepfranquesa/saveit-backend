<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Register extends Model
{
    use HasFactory;

    protected $table = 'registers';

    protected $fillable = [
        'user_id',
        'account_id',
        'objective_id',
        'periodic_id',
        'subcategory_id',
        'amount',
        'origin',
        'name_category',
    ];

    /**
     * Relaciones con otras entidades.
     */

    // Un registro pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un registro pertenece a una cuenta
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // Un registro puede estar asociado a un objetivo (o ser null)
    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }

    // Un registro puede ser periódico (o ser null)
    public function periodic()
    {
        return $this->hasOne(Periodic::class);
    }

    // Un registro pertenece a una subcategoría (o ser null)
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
