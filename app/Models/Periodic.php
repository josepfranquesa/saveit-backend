<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Register;

class Periodic extends Model
{
    use HasFactory;

    protected $table = 'periodics';

    public $timestamps = false;

    protected $fillable = [
        'register_id',
        'periodic_interval',
        'periodic_unit',
        'origen_time_created',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'origen_time_created' => 'datetime',
        'created_at'          => 'datetime',
        'updated_at'          => 'datetime',
    ];

    /**
     * Relación inversa con Register.
     */
    public function register()
    {
        return $this->belongsTo(Register::class);
    }
}
