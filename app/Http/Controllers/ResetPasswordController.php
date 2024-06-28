<?php

namespace App\Http\Controllers;

use App\Services\PasswordResetService;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    protected $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    public function sendResetLinkEmail(Request $request)
    {
        return $this->passwordResetService->sendResetLinkEmail($request->email);
    }

    public function showResetForm($token, Request $request)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->query('email')]);
    }

    public function resetEmailPassword(Request $request, $token, $email)
    {
        $response = $this->passwordResetService->resetPassword([
            'email' => $email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'token' => $token,
        ]);

        return response()->json(['message' => $response['message']], $response['status']);
    }

}
