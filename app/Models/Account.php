<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    // Campos rellenables (mass assignment)
    protected $fillable = [
        'title',
        'host',
        'balance',
    ];

    public function registers()
    {
        return $this->hasMany(Register::class);
    }

    public function user_accounts()
    {
        return $this->hasMany(UserAccount::class);
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }
}
