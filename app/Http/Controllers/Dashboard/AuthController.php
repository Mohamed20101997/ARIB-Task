<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AuthInterface;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    /**
     * @var AuthInterface $authInterface
     */
    private $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function getLogin(){
        return $this->authInterface->getLogin();
    }


    public function login(Request $request){
        return $this->authInterface->login($request);
    }

    public function logout(){
        return $this->authInterface->logout();
    }
}
