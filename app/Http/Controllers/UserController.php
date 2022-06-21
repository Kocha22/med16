<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Education;
use App\Models\Applicant;
use App\Models\Attestation;
use App\Models\Formation;
use App\Models\Extra;
use App\Models\Experience;
use Auth;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserController extends Controller
{
    public function index($user_id)
    {
    $user_id=Auth::user()->id;
    $post=Applicant::where('user_id', $user_id)->first();
    return view('personal.profile', ['post'=>$post, 'user_id'=>$user_id]);
    }
    public function geteducation($user_id)
    {
    $user_id=Auth::user()->id;
    $data= User::findOrFail($user_id)->usersed;
    return view('personal.education', ['data'=>$data, 'user_id'=>$user_id]);
    }
    public function getformation($user_id)
    {
    $user_id=Auth::user()->id;
    $data= User::findOrFail($user_id)->usersformation;
    return view('personal.formation', ['data'=>$data, 'user_id'=>$user_id]);
    }
    public function getexperience($user_id)
    {
    $user_id=Auth::user()->id;
    $data= User::findOrFail($user_id)->usersexp;
    return view('personal.experience', ['data'=>$data, 'user_id'=>$user_id]);
    }
    public function getattestation($user_id)
    {
    $user_id=Auth::user()->id;
    $data= User::findOrFail($user_id)->usersatt;
    return view('personal.attestation', ['data'=>$data, 'user_id'=>$user_id]);
    }
    public function getextra($user_id)
    {
    $user_id=Auth::user()->id;
    $data= User::findOrFail($user_id)->usersext;
    return view('personal.extra', ['data'=>$data, 'user_id'=>$user_id]);
    }
    
      /**
     * Forgot password
     * @param NA
     * @return view
     */
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Validate token for forgot password
     * @param token
     * @return view
     */
    public function forgotPasswordValidate($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            $email = $user->email;
            return view('auth.change-password', ['email' => $email ]);
        }
        return redirect()->route('forgot-password')->with('Ошибка', 'Срок действия ссылки для сброса пароля истек');
    }

    /**
     * Reset password
     * @param request
     * @return response
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('Ошибка', 'Ошибка! электронная почта не зарегистрирована.');
        }

        $token = Str::random(60);

        $user['remember_token'] = $token;
        $user->save();

        Mail::to($request->email)->send(new ResetPassword($user->name, $token));

        if(Mail::failures() != 0) {
            return back()->with('success', 'Ссылка для сброса пароля успешно отправлена на вашу почту');
        }
        return back()->with('failed', 'Ошибка! Проблема по отправке на почту');
    }

    /**
     * Change password
     * @param request
     * @return response
     */
    public function updatePassword(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user['password'] = Hash::make($request->password);
            $user->save();
            return redirect()->route('auth.get.login')->with('success', 'Пароль был успешно изменен');
        }
        return redirect()->route('forgot-password')->with('failed', 'Ошибка! Что-то пошло не так');
    }




}
