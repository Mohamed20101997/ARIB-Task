<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\HomeReserve;
use App\Models\Owners;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index()
    {
        return view('dashboard.welcome');

    } //end of index

} //end of controller
