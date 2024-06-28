<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\PasswordResetRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordResetService
{
    protected $passwordResetRepository;

    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    public function sendResetLinkEmail(string $email)
    {
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return [
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
                'status' => 422,
            ];
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return ['message' => 'User not found.', 'status' => 404];
        }

        $token = Str::random(60);

        $this->passwordResetRepository->updateOrInsert($email, Hash::make($token));

        return ['message' => 'Password reset token generated.', 'token' => $token, 'status' => 200];
    }

    public function resetPassword(array $data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
                'status' => 422,
            ];
        }

        $passwordReset = $this->passwordResetRepository->findByEmail($data['email']);

        if (!$passwordReset || !Hash::check($data['token'], $passwordReset->token)) {
            return ['message' => 'Invalid token.', 'status' => 400];
        }

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return ['message' => 'User not found.', 'status' => 404];
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        $this->passwordResetRepository->deleteByEmail($data['email']);

        return ['message' => 'Password has been reseted.', 'status' => 200];
    }
}
