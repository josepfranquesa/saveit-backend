<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Register;

class Periodic extends Model
{
    use HasFactory;

    protected $table = 'periodics';

    protected $fillable = [
        'register_id',
        'frequency',
        'timeOfDay',
        'dayOfWeek',
        'dayOfMonth',
        'dayOfYear',
        'specificDates',
    ];

    protected $casts = [
        'specificDates' => 'array',
    ];

    // Relación con Register (muchos a uno)
    public function register()
    {
        return $this->belongsTo(Register::class);
    }
}
