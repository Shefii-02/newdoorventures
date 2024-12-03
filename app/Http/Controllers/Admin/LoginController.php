<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Account;
use App\Traits\AdminAuthenticatesUsers;
use App\Traits\LogoutGuardTrait;

class LoginController extends Controller
{
    use AdminAuthenticatesUsers, LogoutGuardTrait;

    public string $redirectTo = '/admin/dashboard';

    protected function guard()
    {
        return auth('web');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login'); // Login form view
    }

    public function showRegisterForm()
    {
       abort(404);
    }

    public function register(Request $request)
    {
        abort(404);
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('user.login'));
    }
}
