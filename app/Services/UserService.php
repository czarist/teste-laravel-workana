<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

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
