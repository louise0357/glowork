<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
        }

        $status = Password::sendResetLink(['email' => $user->email]);

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __('Şifre sıfırlama bağlantısı başarıyla gönderildi.')], 200)
            : response()->json(['message' => __($status)], 400);
    }

    public function reset(Request $request)
    {
        $user_email = $request->email;

        if (!$user_email) {
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
        }

        $status = Password::sendResetLink(['email' => $user_email]);

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __('Şifre sıfırlama bağlantısı başarıyla gönderildi.')], 200)
            : response()->json(['message' => __($status)], 400);
    }
    

    protected function sendResetResponse(Request $request, $response)
    {
        return redirect()->route('home')->with('status', __($response));
    }
}
