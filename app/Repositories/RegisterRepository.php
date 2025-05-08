<?php
namespace App\Repositories;

use App\Models\Register;

class RegisterRepository
{
    public function getAll()
    {
        return Register::all();
    }

    public static function find($id)
    {
        return Register::findOrFail($id);
    }

    public function create(array $data)
    {
        return Register::create($data);
    }

    public static function update(array $data, $id)
    {
        $register = Register::findOrFail($id);
        $register->update($data);
        return $register;
    }

    public static function delete($id)
    {
        return Register::destroy($id);
    }

    public function getByAccountId($accountId)
    {
        return Register::where('account_id', $accountId)->orderBy('created_at', 'desc')->get();
    }

    public static function createNormal($data)
    {
        return Register::create([
            'user_id'        => $data['user_id'],
            'account_id'     => $data['account_id'],
            'amount'         => $data['amount'],
            'origin'         => $data['origin'],
            'subcategory_id' => $data['subcategory_id'] ?? null,
            'name_category'  => $data['name_category'] ?? null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    public static function findByAcountSubcategory($id_subCat, $accountId){
        return Register::where('account_id', $accountId)->where('subcategory_id', $id_subCat)->orderBy('created_at', 'desc')->get();
    }
}
