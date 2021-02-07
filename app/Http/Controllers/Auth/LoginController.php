<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public $service;
    function __construct(UserService $service)
    {
        $this->service=$service;
    }
    function login()
    {
        $data=$this->service->validateLogin();
        if(Auth::attempt($data))
        {
            return redirect()->route('home');
        }
        else
        {
            return back()->with('loginFail',"Account doesn't exist");
        }
    }
}
