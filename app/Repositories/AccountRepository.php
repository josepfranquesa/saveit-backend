<?php
namespace App\Repositories;

use App\Models\Account;

class AccountRepository
{
    public static function findAccountById($id) {
        return Account::findOrFail($id);
    }

    public function createAccount($host, $title, $balance) {
        $account = Account::create([
            'title' => $title,
            'host' => $host,
            'balance' => $balance,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $account;
    }

    public function updateAccount($id, $data) {}

    public function deleteAccount($id) {}

    public function getAccountsByIds(array $accountIds)
    {
        return Account::whereIn('id', $accountIds)->get();
    }
}
