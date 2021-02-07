<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegisterSuccessEvent;
use App\Http\Controllers\Controller;
use App\Http\Respositories\RespositoryInterface;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $respo;
    private $service;
    function __construct(RespositoryInterface $respo,UserService $service)
    {
        $this->respo=$respo;
        $this->service=$service;
        
    }
    function register()
    {
        $data=$this->service->validateRegister();
        $this->respo->create($data);
        event(new RegisterSuccessEvent($data));
        return redirect()->route('loginView');
        

     }
}
