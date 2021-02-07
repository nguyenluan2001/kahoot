<?php
namespace App\Http\Services;
class UserService
{
    function validateRegister()
    {
        return request()->validate([
            'fullname'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
    }
    function validateLogin()
    {
        return request()->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
    }
       
    
}