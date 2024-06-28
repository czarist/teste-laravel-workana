<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PasswordResetRepository
{
    public function findByEmail(string $email)
    {
        return DB::table('password_resets')->where('email', $email)->first();
    }

    public function updateOrInsert(string $email, string $token)
    {
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]
        );
    }

    public function deleteByEmail(string $email)
    {
        DB::table('password_resets')->where('email', $email)->delete();
    }
}
