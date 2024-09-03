<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;

class AuthRepository implements AuthInterface
{

    public function getLogin()
    {
        return view('dashboard.auth.login');
    }

    public function login($request)
    {
        $remember_token = $request->has('remember_token') ? true : false ;

        // Determine if login is email or phone
        $login = $request->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Attempt to log in using either email or phone
        if (auth()->guard('admin')->attempt([$fieldType => $login, 'password' => $request->input('password')], $remember_token)) {
            return redirect()->route('welcome');
        }

        return \Redirect::back()->withErrors(['msg' => 'Invalid email|phone or password.']);
    }

    public function logout()
    {
        $guard  = $this->getGaurd();
        $guard->logout();
        return redirect()->route('login');
    }

    private function getGaurd(){
        return auth('admin');
    }


}
