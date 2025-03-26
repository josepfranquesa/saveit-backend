<?php
namespace App\Repositories;

use App\Models\UserAccount;

class UserAccountRepository
{
    public function getAccountIdsForUser($userId)
    {
        return UserAccount::where('user_id', $userId)->pluck('account_id')->toArray();
    }
}
