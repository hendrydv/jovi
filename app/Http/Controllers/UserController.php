<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function login(Request $request): view|RedirectResponse
    {
//        $request->validate([
//            'email' => 'required',
//            'password' => 'required',
//        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('home')->with('succes', 'U bent succesvol ingelogd');
        }

        return view('user.login', [
            'title' => 'Inloggen',
        ])->with('error', 'Uw inloggegevens zijn onjuist');
    }
}
