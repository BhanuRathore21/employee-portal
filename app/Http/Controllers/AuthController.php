<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function apiregister(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'organization' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
            'language' => 'nullable|string',
            'password' => 'required|string|min:6',
        ]);
    
        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'organization' => $request->organization,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'language' => $request->language,
            'password' => Hash::make($request->password),
        ]);
    
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    // login a user method
    public function apilogin(LoginRequest $request) {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect!'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 24); 

        return response()->json([
            'user' => new UserResource($user),
        ])->withCookie($cookie);
    }

    // logout a user method
    public function apilogout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        $cookie = cookie()->forget('token');

        return response()->json([
            'message' => 'Logged out successfully!'
        ])->withCookie($cookie);
    }

    public function user(Request $request) {
        return new UserResource($request->user());
    }
}
