<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    // create user
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    // ->mixedCase()
                    // ->numbers()
                    // ->symbols()
                    // ->uncompromised()
            ],
            'password_confirmation' => 'required|same:password'
        ]);

        DB::table('users')->insert([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
            // 'password' => $request['password']
        ]);
        session()->flash('status', 'User ' . $request['name'] . ' created successful!');

        return redirect(route('bookings.main'));
    }

}
