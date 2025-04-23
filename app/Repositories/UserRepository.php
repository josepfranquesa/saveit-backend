<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function getAllUsers()
    {
        return User::whereNull('deleted_at')->get();
    }

    public static function getUserById($id)
    {
        return User::whereNull('deleted_at')->findOrFail($id);
    }

    public static function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function updateUser($id, $data)
    {
        $user = User::whereNull('deleted_at')->findOrFail($id);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password,
        ]);
        return $user;
    }

    public function softDeleteUser($id)
    {
        $user = User::whereNull('deleted_at')->findOrFail($id);
        return $user->delete();
    }

}
