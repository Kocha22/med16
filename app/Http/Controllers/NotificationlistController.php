<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Participant;
use App\Models\Programm;
use App\Models\Listnotification;
use Auth;
use Carbon\Carbon;
use Validator;

class NotificationlistController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'typenotification_id' => 'required',
            'text' => 'required',
            'date_note' => 'required'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $post_data = $request->all('typenotification_id', 'contest_id', 'text', 'date_note');
        
        $posts = Listnotification::create($post_data);

         return response()->json(['code' => 200,'msg' => 'Письмо "На рассмотрений" отправлено заявителю.']);
    }
}
