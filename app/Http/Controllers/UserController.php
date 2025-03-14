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
    $errors = []; // Almacenar errores
    $errorFields = []; // Almacenar qué campos fallaron

    // Validar formato del email
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|yahoo\.com|outlook\.com)$/', $request->email)) {
        $errors['email'] = 'El correo no tiene un formato válido. Debe ser @gmail.com, @hotmail.com, @yahoo.com o @outlook.com.';
        $errorFields[] = 'email';
    }

    // Comprobar si el email ya existe en la base de datos
    if (\App\Models\User::where('email', $request->email)->exists()) {
        $errors['email'] = 'El usuario con este correo ya existe.';
        $errorFields[] = 'email';
    }

    // Validar email_confirmation
    if ($request->email !== $request->email_confirmation) {
        $errors['email_confirmation'] = 'El correo de confirmación no coincide con el correo ingresado.';
        $errorFields[] = 'email_confirmation';
    }

    // Comprobar si el teléfono ya está registrado
    if (\App\Models\User::where('phone', $request->phone)->exists()) {
        $errors['phone'] = 'El teléfono ya está registrado en el sistema.';
        $errorFields[] = 'phone';
    }

    // Validar formato del teléfono (exactamente 9 números)
    if (!preg_match('/^[0-9]{9}$/', $request->phone)) {
        $errors['phone'] = 'El teléfono no tiene el formato correcto. Debe contener exactamente 9 dígitos numéricos.';
        $errorFields[] = 'phone';
    }

    // Validar contraseña con mínimo 8 caracteres
    if (strlen($request->password) < 8) {
        $errors['password'] = 'La contraseña es demasiado corta. Debe tener al menos 8 caracteres.';
        $errorFields[] = 'password';
    }

    // Validar que password_confirmation coincida
    if ($request->password !== $request->password_confirmation) {
        $errors['password_confirmation'] = 'La confirmación de la contraseña no coincide con la contraseña ingresada.';
        $errorFields[] = 'password_confirmation';
    }

    // Si hay errores, devolverlos junto con los campos que fallaron
    if (!empty($errors)) {
        return response()->json([
            'success' => false,
            'errors' => $errors,
            'error_fields' => $errorFields
        ], 422);
    }

    // Crear usuario si no hay errores
    $userData = $request->only(['name', 'email', 'phone', 'password']);
    $userData['password'] = bcrypt($userData['password']); // Encriptar contraseña

    $user = \App\Models\User::create($userData);

    return response()->json([
        'success' => true,
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
