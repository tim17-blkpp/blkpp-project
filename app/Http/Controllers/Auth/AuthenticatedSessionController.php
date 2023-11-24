<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $toptitle = 'Login';
        $title = 'Auth';
        $subtitle = 'Data Login';

        return view('login', compact(
            'toptitle',
            'title',
            'subtitle',
        ));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;

        $request->session()->put('token', $token);

        if ($user->role == 'Kandidat') {
            return redirect()->route('dashboard-kandidat.index')->with(['success' => 'Selamat Datang Kembali!']);
        } else {
            return redirect()->route('dashboard.index')->with(['success' => 'Selamat Datang Kembali!']);
        }

        // return redirect()->intended(RouteServiceProvider::HOME)->header('Authorization', 'Bearer ' . $token);
        // return response()->json([
        //     'response_code' => 200,
        //     'message' => 'sucess',
        //     'data' => [
        //         'user' => $user,
        //         'token' => $token,
        //     ]
        //     ], 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        PersonalAccessToken::where('tokenable_id', $request->user()->id)
            ->where('tokenable_type', get_class($request->user()))
            ->delete();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
