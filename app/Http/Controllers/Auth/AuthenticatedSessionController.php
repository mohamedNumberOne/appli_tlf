<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                $route = 'dashboard';
                break;
            case 'commercial':
                $route = 'dashboard_commercial';
                break;
            case 'prop_store':
                $route = 'dashboard_store';
                break;

            default:
                $route = 'login';
                break;
        }

        if ($role == 'admin' || $role == 'commercial' || $role == 'prop_store') {
            return redirect()->intended(route($route, absolute: false));
        } else {
            Auth::logout();
            redirect()->route('login')->with('error', 'erreur du role !!');
        }


        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
