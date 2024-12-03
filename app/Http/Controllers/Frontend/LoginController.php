<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Account;
use App\Traits\AuthenticatesUsers;
use App\Traits\LogoutGuardTrait;

class LoginController extends Controller
{
    use AuthenticatesUsers, LogoutGuardTrait;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $account = Account::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth('account')->login($account);

        return redirect($this->redirectTo);
    }

    public function logout(Request $request)
    {
        auth('account')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('user.login'));
    }
}
