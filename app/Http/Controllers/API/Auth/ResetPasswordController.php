<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function forgot(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $user = User::whereEmail($request->email)->first();
        if (! $user) {
            return response()->json(['message' => trans('User does not exist')], 400);
        }
        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        if ($this->sendResetEmail($user, $token)) {
            return response()->json(['message' => trans('A reset link has been sent to your email address.')]);
        } else {
            return response()->json(['message' => trans('A Network Error occurred. Please try again.')], 400);
        }
    }

    private function sendResetEmail(User $user, $token): bool
    {
        $link = config('app.url') . '/reset-password/' . $token . '?email=' . urlencode($user->email);

        try {
            $user->notify(new ResetPasswordNotification($link));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function reset(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:6|confirmed'
        ]);

        $password = $request->password;
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->where('email', $request->email)->first();
        if (!$tokenData) return response()->json(['message' => trans('This password reset token is invalid.')], 400);

        $user = User::where('email', $tokenData->email)->first();
        if (!$user) return response()->json(['message' => trans('User not found !')], 400);

        $user->password = Hash::make($password);
        $user->save();

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        //Send Email Reset Success Email
        event(new PasswordReset($user));

        return response()->json(['message' => 'Password Reset successful']);
    }

    /**
     * @throws ValidationException
     */
    public function updatePassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|min:6|confirmed'
        ]);
        $user = auth('sanctum')->user();

        if(Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json([
                'message' => 'Password successfully updated',
            ], 201);
        } else {
            throw ValidationException::withMessages(['current_password' => 'Current password is incorrect']);
        }
    }

}
