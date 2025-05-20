<?php
namespace App\Repositories;

use App\Models\Graphic;

class GraphRepository
{
    public static function findByAccountId($accountId){
        return Graphic::where('account_id', $accountId)->orderBy('created_at', 'desc')->get();
    }

    public static function create($data)
    {
        return Graphic::create($data);
    }
    public static function findById($id)
    {
        return Graphic::find($id);
    }

    public static function delete(Graphic $graphic)
    {
        return $graphic->delete();
    }


}
