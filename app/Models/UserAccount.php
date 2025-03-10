<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserAccount extends Pivot
{
    protected $table = 'useraccount'; // Nombre de la tabla

    protected $fillable = [
        'user_id',
        'account_id',
    ];

    public $timestamps = true; // Se activan timestamps

    /**
     * Relaciones con User y Account
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
