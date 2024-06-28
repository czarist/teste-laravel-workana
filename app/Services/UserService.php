<?php

namespace App\Services;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function validateRegistrationData(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cep' => 'required|string|max:9', // Considerando o formato "00000-000"
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'country' => 'required|string|max:255',
        ]);
    }

    public function createUserWithAddress(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Address::create([
            'cep' => $data['cep'],
            'street' => $data['street'],
            'number' => $data['number'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
