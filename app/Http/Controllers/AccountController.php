<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AccountRepository;

class AccountController extends Controller
{
    protected $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function index() {} // Obtener todas las cuentas

    public function show($id) {} // Obtener una cuenta por ID

    public function store(Request $request) {} // Crear una nueva cuenta

    public function update(Request $request, $id) {} // Actualizar una cuenta

    public function destroy($id) {} // Eliminar una cuenta
}
