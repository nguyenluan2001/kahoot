<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function home()
    {
        $user=User::find(auth()->user()->id);
        $list_quizzs=$user->load("quizzs");
        // return $list_quizzs;
        return view('home',compact('list_quizzs'));
    }
}
