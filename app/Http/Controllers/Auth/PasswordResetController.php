<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class PasswordResetController extends Controller
{
    public function requestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetTokenViaWhatsApp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        $token = Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $twilioSid = env('USb3f7e9defabf2e65873d7fc3f4a94a2e');
        $twilioToken = env('ZSFSL1T5VDTNWNUUKERT721H');
        $twilioNumber = env('+6285933554649');

        $client = new Client($twilioSid, $twilioToken);

        $message = "Your password reset token is: $token. Click the link to reset your password: " . url('/password/reset/' . $token);

        $client->messages->create(
            'whatsapp:' . $user->whatsapp_number,
            [
                'from' => 'whatsapp:' . $twilioNumber,
                'body' => $message,
            ]
        );

        return back()->with('status', 'We have sent your password reset link to your WhatsApp.');
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_resets')->where('token', Hash::make($request->token))->first();

        if (!$passwordReset || $passwordReset->email != $request->email) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password has been reset!');
    }
}
