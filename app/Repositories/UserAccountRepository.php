<?php
namespace App\Repositories;

use App\Models\UserAccount;

class UserAccountRepository
{
    public function getAccountIdsForUser($userId)
    {
        return UserAccount::where('user_id', $userId)->pluck('account_id')->toArray();
    }

    public function getUsersForAccount($accountId)
    {
        return UserAccount::where('account_id', $accountId)->pluck('user_id')->toArray();
    }

    public function delete($accountId, $userId)
    {
        return UserAccount::where('account_id', $accountId)->where('user_id', $userId)->delete();
    }
}
