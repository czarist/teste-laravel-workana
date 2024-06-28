<?php

namespace App\Http\Controllers;

use App\Services\CepService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;
    protected $cepService;

    public function __construct(UserService $userService, CepService $cepService)
    {
        $this->userService = $userService;
        $this->cepService = $cepService;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->userService->validateRegistrationData($request->all())->validate();
        $user = $this->userService->createUserWithAddress($request->all());

        Auth::login($user);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function validateCep(Request $request)
    {
        $cep = $request->input('cep');
        $cepData = $this->cepService->getCepData($cep);
        return response()->json($cepData);
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

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
