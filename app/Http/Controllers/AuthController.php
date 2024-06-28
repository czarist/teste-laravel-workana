<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->userService->validateRegistrationData($request->all())->validate();
        $user = $this->userService->createUser($request->all());

        Auth::login($user);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'Login successful'], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function validateCep(Request $request)
    {
        $cep = $request->cep;
        $address = file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
        return response()->json(json_decode($address));
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
