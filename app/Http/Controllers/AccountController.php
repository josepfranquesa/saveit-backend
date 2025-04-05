<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AccountRepository;
use App\Repositories\UserAccountRepository;
use App\Repositories\UserRepository;

class AccountController extends Controller
{
    protected $accountRepository;
    protected $userAccountRepository;
    protected $userRepository;

    public function __construct(
        AccountRepository $accountRepository,
        UserAccountRepository $userAccountRepository,
        UserRepository $userRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->userAccountRepository = $userAccountRepository;
        $this->userRepository = $userRepository;
    }


    public function show($id) {} // Obtener una cuenta por ID

    public function store(Request $request) {} // Crear una nueva cuenta

    public function update(Request $request, $id) {} // Actualizar una cuenta

    public function destroy($id) {} // Eliminar una cuenta

    public function getAccountsForUser($id)
    {
        $accountIds = $this->userAccountRepository->getAccountIdsForUser($id);
        $accounts = $this->accountRepository->getAccountsByIds($accountIds);

        $formattedAccounts = [];
        foreach ($accounts as $account) {
            $userIds = $this->userAccountRepository->getUsersForAccount($account->id);
            $accountUsers = [];
            foreach ($userIds as $userId) {
                $userDetails = $this->userRepository->getUserById($userId);
                if ($userDetails) {
                    $accountUsers[] = [
                        'id'    => $userDetails->id,
                        'name'  => $userDetails->name,
                        'email' => $userDetails->email,
                    ];
                }
            }

            $formattedAccounts[] = [
                'id'           => $account->id,
                'title'        => $account->title,
                'balance'      => $account->balance,
                'created_at'   => $account->created_at,
                'account_user' => $accountUsers,
            ];
        }

        return response()->json(['accounts' => $formattedAccounts]);
    }


}
