<?php
namespace App\Repositories;

use App\Models\Register;

class RegisterRepository
{
    public function getAll()
    {
        return Register::all();
    }

    public function find($id)
    {
        return Register::findOrFail($id);
    }

    public function create(array $data)
    {
        return Register::create($data);
    }

    public function update($id, array $data)
    {
        $register = Register::findOrFail($id);
        $register->update($data);
        return $register;
    }

    public function delete($id)
    {
        return Register::destroy($id);
    }

    public function getByAccountId($accountId)
    {
        return Register::where('account_id', $accountId)->get();
    }
}
