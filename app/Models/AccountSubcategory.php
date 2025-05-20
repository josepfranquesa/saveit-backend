<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSubcategory extends Model
{
    protected $table = 'account_category_subcategory';

    protected $fillable = ['account_id', 'category_id', 'subcategory_id'];

    public $timestamps = false;

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }



}
