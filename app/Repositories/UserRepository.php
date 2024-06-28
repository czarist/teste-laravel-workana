<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function findUserWithAddress($id)
    {
        return User::with('address')->find($id);
    }

    public function updateUser($id, array $data)
    {
        $user = User::find($id);

        if ($user) {
            $user->update($data);
        }

        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return $user;
    }
    public function create(array $data)
    {
        return User::create($data);
    }

}
