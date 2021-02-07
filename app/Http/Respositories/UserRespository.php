<?php
namespace App\Http\Respositories;
use App\Http\Respositories\RespositoryInterface;
use App\User;

class UserRespository implements RespositoryInterface
{
    function create($data)
    {
        User::create($data);
    }
    function get_user_by_id()
    {

    }
}