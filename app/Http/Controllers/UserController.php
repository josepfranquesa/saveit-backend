<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Repositories\UserAccountRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $userData = $request->only(['name', 'email', 'phone', 'password']);
        $userData['password'] = bcrypt($userData['password']);

        $user = UserRepository::createUser($userData);

        $token = $user->createToken('flutter-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 3600,
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

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        $token = $user->createToken('flutter-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => 3600,
            'user'         => $user
        ], 200);
    }


    // public function checkToken(Request $request)
    // {
    //     $user = User::where('remember_token', $request->token)->first();

    //     if (!$user) {
    //         return response()->json(['message' => 'Token inválido'], 401);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'user' => $user
    //     ], 200);
    // }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token no encontrado en la petición'
            ], 400);
        }

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no autenticado'
            ], 401);
        }

        $eloquentUser = User::find($user->id);
        if ($eloquentUser) {
            $eloquentUser->remember_token = null;
            $eloquentUser->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Sesión cerrada exitosamente'
        ]);
    }

    public function getUsersForAccount($accountId)
    {
        $userIds = UserAccountRepository::getUsersForAccount($accountId);

        $users = [];
        foreach ($userIds as $id) {
            $users[] = UserRepository::getUserById($id);
        }

        return response()->json($users);
    }


}
