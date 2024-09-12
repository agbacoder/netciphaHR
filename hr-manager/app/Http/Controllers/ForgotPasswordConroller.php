<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordConroller extends Controller
{
    public function sendResetEmailLink(Request $request)
    {
        $request->validate(['email' => 'required|email',]);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT ? response()->json([
            'message' => __($status)
        ], 200) : response()->json([
            'message' => __($status)
        ], 401);
    }
}
