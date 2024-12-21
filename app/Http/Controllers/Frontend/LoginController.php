<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Account;
use App\Traits\AuthenticatesUsers;
use App\Traits\LogoutGuardTrait;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers, LogoutGuardTrait;

    use \App\Emails;
    
    public string $redirectTo = '/account/dashboard';

    protected function guard()
    {
        return auth('account');
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Login form view
    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Register form view
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'email' => 'required|email|unique:re_accounts,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $account = Account::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 'pending',
            'password' => Hash::make($request->password),
        ]);

        $this->accountCreated($account);
        auth('account')->login($account);

        return redirect($this->redirectTo);
    }

    public function showRestForm(Request $request)
    {

        return view('auth.passwords.forgot-password');
    }

    public function SendRestForm(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $userExists = \App\Models\Account::where('email', $request->email)->exists();

        if (!$userExists) {
            return back()->withErrors(['email' => 'The email address does not exist in our records.']);
        }

        // Attempt to send the reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the status and return appropriate response
        if ($status === Password::RESET_LINK_SENT) {
            // Flash success message to session and redirect back
            return back()->with('success', 'A password reset link has been sent to your email address.');
        } else {
            // Flash error message to session and redirect back
            return back()->withErrors(['email' => 'Failed to send reset link. Please try again later.']);
        }
    }


    public function ResetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Account $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('user.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request)
    {
        auth('account')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('user.login'));
    }
}
