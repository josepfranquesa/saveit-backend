<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AccountRepository;
use App\Repositories\UserAccountRepository;

class AccountController extends Controller
{
    protected $accountRepository;
    protected $userAccountRepository;

    public function __construct(
        AccountRepository $accountRepository,
        UserAccountRepository $userAccountRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->userAccountRepository = $userAccountRepository;
    }


    public function show($id) {} // Obtener una cuenta por ID

    public function store(Request $request) {} // Crear una nueva cuenta

    public function update(Request $request, $id) {} // Actualizar una cuenta

    public function destroy($id) {} // Eliminar una cuenta

    public function getAccountsForUser($id)
    {
        //Obtener lista de IDs de cuentas asociadas al usuario
        $accountIds = $this->userAccountRepository->getAccountIdsForUser($id);

        //Obtener las cuentas con esos IDs
        $accounts = $this->accountRepository->getAccountsByIds($accountIds);

        //Devolver como respuesta JSON
        return response()->json($accounts);
    }
}
