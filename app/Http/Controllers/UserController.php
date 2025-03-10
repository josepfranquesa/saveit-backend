<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = $this->userRepository->getUserById($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', //comprova que no exsiteixi cap usuari amb aquest email
            'email_confirmation' => 'required|string|email|max:255|same:email', //comprova que s'hagui entrat dos cops el mateix correu
            'phone' => 'required|string|max:15|unique:users', //comprova que no exsiteixi cap usuari amb aquest telefon
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password', //comprova que s'hagui entrat dos cops el mateix password
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Crear el usuario
        $userData = $request->only(['name', 'email', 'phone', 'password']);
        $userData['password'] = bcrypt($userData['password']); // Encriptar la contraseña

        $user = $this->userRepository->createUser($userData);

        return response()->json([
            'message' => 'Usuario creado con éxito',
            'user' => $user
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $this->userRepository->updateUser($id, $request->all());

        return response()->json([
            'message' => 'Usuario actualizado con éxito',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $this->userRepository->softDeleteUser($id);
        return response()->json([
            'message' => 'Usuario eliminado'
        ]);
    }

}
