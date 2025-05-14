<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Graphic extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'graphics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'periodo',
        'start_date',
        'end_date',
        'labels',
        'data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'labels'     => 'array',
        'data'       => 'array',
    ];

    /**
     * A graphic belongs to an account.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
