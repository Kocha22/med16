<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contest;
use App\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Participant;
use App\Models\Programm;
use App\Models\Listnotification;
use App\Models\Typenotification;
use App\Mail\SendContest;
use Auth;
use Carbon\Carbon;
use Validator;
use Pusher\Pusher;

class ContestController extends Controller
{
    public function index()
    {
        $date = Carbon::now();// will get you the current date, time 
        $date2 = $date->format("Y-m-d"); 
        $department=Department::get();
        $user_id=Auth::user()->id;
        $position=Position::get();
        $user = User::where('id', $user_id)->first();
        $posts=Contest::with('appcontests')->get();
        return view('vacancy', ['posts'=>$posts, 'user'=>$user, 'date2'=>$date2, 'department'=>$department, 'position'=>$position]);
    }

    public function store(Request $request)
    {
        $rules = [
            'department_id' => 'required',
            'position_id' => 'required',
            'date_app' => 'required'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $post_data = $request->all('department_id', 'position_id', 'date_app');
        
        $posts = Contest::create($post_data);

        $allusers = Applicant::where('appuserstatus_id', 15)->get();

        foreach($allusers as $user){
            Mail::to($user->email)->send(new SendContest($posts));       
        }

        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['user_to' => 63];
        $pusher->trigger('my-channel', 'my-eventContest', $data);
         
         return response()->json(['code' => 200,'msg' => 'Письмо "На рассмотрений" отправлено заявителю.']);
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
        return view('showcontest', ['post'=>$post, 'participant'=>$participant, 'post2'=>$post2, 'post3'=>$post3, 'type'=>$type, 'date2'=>$date2, 'user'=>$user]);
    }
    public function saction(Request $request, $user_id, $post_id){
        if($request->ajax()) {
            
            $post = Applicant::where('user_id', $user_id)->update([
                'appuserstatus_id' => 8
            ]); 
            $post = Applicant::where('user_id', $user_id)->first();

            $contest = Contest::findOrFail($post_id);

            $post->contests()->attach($contest);

            return response()->json(['code' => 200, 'msg' => 'Ваша заявка подано', 'user_id'=>$user_id]);
        }
    }
}
