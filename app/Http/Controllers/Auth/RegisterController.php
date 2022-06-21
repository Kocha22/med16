<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegistration;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class RegisterController extends Controller 
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function registerajax(Request $request)
    {
     if($request->ajax())
     {
        $post_id=1;
        $batken="Форма регистрации";
        $count2='';
        $output = '';
        $output .= '
     
        <input type="hidden" value="{{ csrf_field() }}">
                <div class="alert_inner2">                           
                <input type="email"  class="input_register2" name="email" placeholder="Электронный адрес">
                <span class="form_right"> Введите актуальный электронный адрес</span>
                </div> 
                <span class="text-danger error-text email_error"></span> 
                 <div class="alert_inner2">                           
                <input type="text"  class="input_register2" name="surname" placeholder="Фамилия">
                 <span class="form_right">Введите фамилию по паспорту</span>
                </div>
                <span class="text-danger error-text surname_error"></span> 
                <div class="alert_inner2">                           
                <input type="text"  class="input_register2" name="name" placeholder="Имя">
                <span class="form_right">Введите имя по паспорту</span>
                </div>    
                <span class="text-danger error-text name_error"></span>  
                <input type="hidden" name="role_id" value="3">
                <div class="alert_inner2">                           
                <input type="password"  class="input_register2" name="password" placeholder="Пароль">
                <span class="form_right">Создайте пароль для входа в личный кабинет. Пароль должен содержать не менее 8 знаков(включая буквы и цифры)</span>
                </div>
                 <span class="text-danger error-text password_error"></span> 
                <div class="alert_inner2">                           
                <input type="password"  class="input_register2" name="password_confirmation" placeholder="Повторите пароль">
                <span class="form_right">Примечание</span>
                </div>
                <span class="text-danger error-text password_confirmation_error"></span> 
            <div class="submit_register">
            <input type="submit"  class="input_register-submit" value="Зарегистрироваться">
            </div>
            </form>
          ';
       $items = 'register';
       $data = array(
           'table_data'  => $output,
           'batken' => $batken,
           'post_id' =>$post_id,
           'items'=>$items,
            'count'=>$count2
          );
       echo json_encode($data);
       }
    }
   public function getRegister()
    {
        $roles = Role::get();
        return view('mainregister', ['roles' => $roles]);
    }

    public function postRegister(Request $request)
    {
        $rules = [ 
            'name' => 'required|regex:/^[А-Яа-яЁё]+$/u',
            'surname' => 'required|regex:/^[А-Яа-яЁё]+$/u',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }

        $data = $request->all(['name', 'surname', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);
        $user=$this->user->create($data);
        $token = Str::random(60);
        $user['remember_token'] = $token;
        $user->save();
        event(new Registered($user));
        $user->roles()->sync($request->role_id);
        $user1 = [];
        $user1 = $user['id'];
        $user1 = $user['email'];
        $user1 = $user['password'];
        Auth::attempt($request->all(['email', 'password']));
        return response()->json(['code' => 200,'msg' => 'На вашу почту отправлено ссылка для активации.']);       
    }
}
