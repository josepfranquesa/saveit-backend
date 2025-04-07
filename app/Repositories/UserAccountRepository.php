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

    public function findUserAccount($userId, $accountId){
        return UserAccount::where('account_id', $accountId)
                          ->where('user_id', $userId)
                          ->first();
    }

    public function delete($accountId, $userId)
    {
        $account = self::findUserAccount($userId, $accountId);
        if($account){
            return $account->delete();
        } else {
            return false;
        }
    }


    public function createUserAccount($userId, $accountId)
    {
        $userAccount = UserAccount::create([
            'user_id' => $userId,
            'account_id' => $accountId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $userAccount;
    }
}
