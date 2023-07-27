<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return apiResponseError(['errors' => [$validator->errors()]], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return apiResponseSuccess([
            $user,
        ], 'User registered successfully', 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return apiResponseError('Invalid credentials', 401);
        }

        $user = Auth::user();
        $name = $user->name;
        $token = $user->createToken('ApiToken')->accessToken;

        return apiResponseSuccess([
            'user' => $name,
            'access_token' => $token,
        ], 'User logged in successfully');
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return apiResponseSuccess(null, 'User logged out successfully');
    }

    public function getUser()
    {
        $id = Auth::user()->id;
        $user = User::selectRaw('id, name, email, role_id')->find($id);

        return apiResponseSuccess($user, 'OK');
    }
}
