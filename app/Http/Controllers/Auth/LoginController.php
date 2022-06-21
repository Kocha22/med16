<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/{user_id}';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
      public function getLogin() 
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request) 
    {
        if(!Auth::attempt($request->all(['email', 'password']))) {
            return redirect()->back()->withErrors(['fail' => 'Неправильный логин или пароль']);
        }

        return redirect()->route('createapplicant');
    }
    
    public function logout() 
    {
        Auth::logout();
        return redirect()->route('auth.get.login');
    }
}
