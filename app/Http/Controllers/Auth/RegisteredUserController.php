<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        return view('auth.register');
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => ['required','string','min:8','confirmed' ],
            'password_confirmation' => ['required','string','min:8','same:password' ],
        ]);


        $user = User::updateOrCreate(
            [
                'phone'=>$request->phone,
            ],
            [
            'name' => $request->name,
            'phone'=>$request->phone,
            'email' => $request->email,
            'email_verified_at'=>now(),
            'password' => Hash::make($request->password),
            'active'=>1,
        ]);

        $user->assignRole('seller');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
