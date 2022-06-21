<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Participant;
use App\Models\Programm;
use App\Models\Protocol;
use App\Models\Listnotification;
use App\Models\Typenotification;
use Auth;
use Carbon\Carbon;
use Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts=Contest::get();
        return view('appointment', ['posts'=>$posts, 'user'=>$user]);
    }

    public function show($id)
    {
        $date = Carbon::now();// will get you the current date, time 
        $date2 = $date->format("Y-m-d"); 
        $type=Typenotification::get();
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        $post= Contest::where('id', $id)->first();
        $post2=Programm::where('contest_id', $id)->first();
        $post3=Listnotification::where('contest_id', $id)->get();
        $participant=Participant::where('contest_id', $id)->first();
        return view('showappointment', ['post'=>$post, 'participant'=>$participant, 'post2'=>$post2, 'post3'=>$post3, 'type'=>$type, 'date2'=>$date2, 'user'=>$user]);
    }

    public function store(Request $request)
    {
        $rules = [
            'number_protocol' => 'required',
            'winner' => 'required',
            'short_description' => 'required'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $post_data = $request->all('number_protocol', 'winner', 'short_description');

        
         $posts = Protocol::create($post_data);

         return response()->json(['code' => '200', 'msg' => 'Письмо "На рассмотрений" отправлено заявителю.']);
    }
}
