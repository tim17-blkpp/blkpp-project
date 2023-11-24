<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ProfilModel;
use App\Models\ProfilPerusahaanModel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $toptitle = 'Login';
        $title = 'Auth';
        $subtitle = 'Data Login';

        return view('register', compact(
            'toptitle',
            'title',
            'subtitle',
        ));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'numeric', 'digits:16', 'not_in:-1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->role != 'Perusahaan') {
            $request->validate([
                'nik' => ['required'],
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'api_token' => Hash::make($request->email),
            'password' => Hash::make($request->password),
        ]);

        $jenis_kelamin = 'L';
        if ((int)(substr($request->nik, 6, 2)) > 40) {
            $jenis_kelamin = 'P';
        }

        if ($request->role != 'Perusahaan') {
            $profil = ProfilModel::create([
                'id_user' => $user->id,
                'nik' => $request->nik,
                'jenis_kelamin' => $jenis_kelamin,
            ]);
        } else {
            $profil = ProfilPerusahaanModel::create([
                'id_user' => $user->id,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
