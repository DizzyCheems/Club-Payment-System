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
        // Check if admin
        if (strpos($user->role, 'ADMIN') !== false) {
            return redirect()
                ->intended($this->redirectPath())
                ->with('success', 'Welcome back, Admin!');
        }

        // Check if the user is registered as a student
        if ($user->student) {
            return redirect()
                ->route('dashboard.user')
                ->with('success', 'Welcome back, Student!');
        }

        // Otherwise, regular user
        return redirect()
            ->route('dashboard.user')
            ->with('success', 'You are now logged in as User');
    }
}
