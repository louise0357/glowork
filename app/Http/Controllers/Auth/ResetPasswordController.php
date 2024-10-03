<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);
    
        $plainToken = $request->token;
    
        $tokenData = DB::table('password_reset_tokens')->get();
    
        $email = null;
        foreach ($tokenData as $data) {
            if (Hash::check($plainToken, $data->token)) {
                $email = $data->email;
                break;
            }
        }
    
        if (!$email) {
            return back()->withErrors(['token' => 'Geçersiz token.']);
        }
    
        $request->merge(['email' => $email]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );
    
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('content.auth.reset-password')->with(
            ['token' => $token]
        );
    }

}
