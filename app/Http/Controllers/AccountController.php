<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AccountRepository;
use App\Repositories\UserAccountRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request) {
        //tengo que obtener el id del usuario, el titulo de la cuenta, el balance de la cuenta
        $host = $request->user_id;
        $accountTitle = $request->title;
        $accountBalance = $request->balance;
        $account = $this->accountRepository->createAccount($host, $accountTitle, $accountBalance);
        $this->userAccountRepository->createUserAccount($host, $account->id);
        return response()->json(['account' => $account, 'message' => 'Cuenta creada correctamente']);
    }

    public function update(Request $request, $id) {} // Actualizar una cuenta

    public static function updateAccountBalance($id, $balance) {
        $account = AccountRepository::findAccountById($id);

        if ($balance > 0) $account->balance -= $balance;
        else $account->balance += abs($balance);

        $account->save();

        return response()->json([
            'account' => $account,
            'message' => 'Balance actualizado correctamente'
        ]);
    }

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

    public function joinAccount(Request $request) {
        $account = AccountRepository::findAccountById($request->id);
        $userId = $request->user_id;
        if(!$this->userAccountRepository->findUserAccount($userId, $account->id)){
            $this->userAccountRepository->createUserAccount($userId, $account->id);
            return response()->json(['account' => $account, 'message' => 'Te has unido correctamente a la cuenta']);
        }
        else return response()->json(['account' => $account, 'message' => 'Ya formas parte de esta cuenta']);
    }
}
