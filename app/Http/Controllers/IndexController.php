<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class IndexController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        return view('dashboard', ['user_id'=>$user_id, 'user'=>$user]);
    }
}
