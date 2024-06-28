<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    protected $userRepository;

    public function validateRegistrationData(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cep' => 'required|string|max:9',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);
    }

    public function createUserWithAddress(array $data)
    {
        $user = $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->address()->create([
            'cep' => $data['cep'],
            'street' => $data['street'],
            'number' => $data['number'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
        ]);

        return $user;
    }

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserWithAddress($id)
    {
        return $this->userRepository->findUserWithAddress($id);
    }

    public function updateUser($id, array $data)
    {
        $user = $this->userRepository->findUserWithAddress($id);

        if (!$user) {
            return ['status' => 404, 'message' => 'User not found'];
        }

        $this->userRepository->updateUser($id, [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if ($user->address) {
            $user->address->update([
                'street' => $data['street'],
                'number' => $data['number'],
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
            ]);
        } else {
            $user->address()->create([
                'street' => $data['street'],
                'number' => $data['number'],
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
            ]);
        }

        return ['status' => 200, 'message' => 'User updated successfully'];
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->deleteUser($id);

        if (!$user) {
            return ['status' => 404, 'message' => 'User not found'];
        }

        return ['status' => 200, 'message' => 'User deleted successfully'];
    }
}
