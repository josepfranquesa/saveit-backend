<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSubcategory extends Model
{
    protected $table = 'account_category_subcategory';

    // Si no tienes columnas created_at/updated_at, desactiva timestamps:
    public $timestamps = false;

    // Los campos que se pueden asignar de forma masiva.
    protected $fillable = ['account_id', 'category_id', 'subcategory_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function categoy()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategoy()
    {
        return $this->belongsTo(SubCategory::class);
    }

}
