<?php
namespace App\Repositories;

use App\Models\Account;

class AccountRepository
{
    public function findAccountById($id) {}

    public function createAccount($data) {}

    public function updateAccount($id, $data) {}

    public function deleteAccount($id) {}

    public function getAccountsByIds(array $accountIds)
    {
        return Account::whereIn('id', $accountIds)->get();
    }
}
