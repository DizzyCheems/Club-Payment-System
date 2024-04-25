<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Check if the user's role contains "ADMIN"
        if (strpos($user->role, 'ADMIN') !== false) {
            // User has ADMIN role, redirect to default HOME route
            return redirect()->intended($this->redirectPath());
        } else {
            // User does not have ADMIN role, redirect to 'dashboard.user' route
            return redirect()->route('dashboard.user');
        }
    }
}
