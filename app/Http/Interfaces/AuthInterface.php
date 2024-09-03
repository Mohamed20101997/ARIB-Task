<?php

namespace App\Http\Interfaces;

interface AuthInterface
{
    public function getLogin();

    public function login($request);

    public function logout();
}
