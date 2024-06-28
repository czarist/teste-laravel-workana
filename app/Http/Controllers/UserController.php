<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show($id)
    {
        $user = $this->userService->getUserWithAddress($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user, 'address' => $user->address]);
    }

    public function update(Request $request, $id)
    {
        $response = $this->userService->updateUser($id, $request->all());

        return response()->json(['message' => $response['message']], $response['status']);
    }

    public function destroy($id)
    {
        $response = $this->userService->deleteUser($id);

        return response()->json(['message' => $response['message']], $response['status']);
    }
}
