<?php
namespace App\Http\Respositories;
interface RespositoryInterface
{
    function create($data);
    function get_user_by_id();
}