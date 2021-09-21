<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $data = $request->all();
        //no email verification
        $data['email_verified_at'] = now();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        // login user
        Auth::login($user);

        return response()->json([
            'token' => $user->createToken(env('APP_NAME'))->plainTextToken,
            'user' => $user
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // for sanctum cookie auth
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $request->session()->regenerate();

            return response()->json([
//                for Authorization header auth
                'token' => $user->createToken(env('APP_NAME'))->plainTextToken,
                'user' => $user
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.']
        ]);
    }

    public function profile(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'user' => auth()->user()
        ]);
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        Auth::logout();

        // remove api tokens too
        $user = auth('sanctum')->user();
        $user->tokens->each->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logged out on all devices!'
        ]);
    }
}
