<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notemessage;
use App\Models\Applicant;
use App\User;
use Auth;
use App\Models\Comment;
use App\Models\Contest;

class NotemessageController extends Controller
{
    public function index($user_id)
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        $post = Applicant::where('user_id', $user_id)->first();
        $post_id = $post->id;

        if($post->notemessage()->where('applicant_id', $post_id)->exists()) {
            $sign =14;         
        } else {
            $sign='';
        }
        
        if(Applicant::where('user_id', $user_id)->where('appuserstatus_id', 14)->exists()) {
            $posts = Contest::get();
            $comments = User::findOrFail($user_id)->comments; 
            $note = Notemessage::findOrFail(1);           
        } else {
            $posts = Contest::get();
            $comments = User::findOrFail($user_id)->comments;
            $note = Notemessage::findOrFail(1);
        }

        Contest::get()->update([
            'read_at' => now()
        ]);
               
        return view('notification', ['posts' => $posts, 'user'=>$user, 'user_id'=>$user_id, 'comments'=>$comments, 'note' => $note, 'sign'=>$sign ]);
    }
    public function attestation($user_id)
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $post = Applicant::where('user_id', $user_id)->first();
        $post_id = $post->id;
        
        if($hasTalk=$post->notemessage()->where('applicant_id', $post_id)->exists()) {
            $sign =14;          
        } else {
            $sign='';
        }

        Comment::where('user_to', $user_id)->update([
            'read_at' => now()
        ]);
        
        $note = Notemessage::findOrFail(1);
        $posts = Contest::get();
        $comments = User::findOrFail($user_id)->comments; 
               
        return view('attestation', ['posts' => $posts, 'user'=>$user, 'user_id'=>$user_id, 'comments'=>$comments, 'note' => $note, 'sign' =>$sign]);
    }
    public function transaction($user_id)
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        
        if(Applicant::where('user_id', $user_id)->where('appuserstatus_id', 3)->exists()) {
            $sign =3;        
        } else {
            $sign = '';
        }

        $note = Notemessage::findOrFail(1);
        $posts = Contest::get();
        $comments = User::findOrFail($user_id)->comments; 
               
        return view('attestation', ['posts' => $posts, 'user'=>$user, 'user_id'=>$user_id, 'comments'=>$comments, 'note' => $note, 'sign' =>$sign ]);
    }
    public function appcontest($user_id)
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        
        if(User::where('id', $user_id)->has('comments')) {
            $sign =4;         
        } 
        
        $note = Notemessage::findOrFail(1);
        $posts = Contest::get();
        $comments = User::findOrFail($user_id)->comments; 
               
        return view('attestation', ['posts' => $posts, 'user'=>$user, 'user_id'=>$user_id, 'comments'=>$comments, 'note' => $note, 'sign' =>$sign ]);
    }

    public function show($post_id)
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $post = Contest::where('id', $post_id)->first(); 
        $post2 = Notemessage::where('id', 1)->first();
        $sign = 1; 

        $post3 = Applicant::where('user_id', $user_id)->first();
        $post3_id = $post3->id;
        $hasTalk=$post3->contests()->where('contest_id', $post_id)->exists();
            
        return view('shownote', ['post'=> $post, 'user'=>$user, 'user_id' => $user_id, 'sign'=>$sign,'hasTalk' => $hasTalk]);
    }
    public function show2($post_id)
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $post = Comment::where('id', $post_id)->first();  
        $sign=2;
        return view('shownote', ['post'=> $post, 'user'=>$user, 'user_id' => $user_id, 'sign'=>$sign]);
    }
    public function show3($post_id)
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        $post2 = Applicant::where('user_id', $user_id)->first();
        $post2_id = $post2->id;
        $hasTalk2=$post2->notemessage()->where('applicant_id', $post2_id)->exists();


        $post_id = 1;
        $post = Notemessage::where('id', $post_id)->first();  
        $sign=3;
        return view('shownote', ['post'=> $post, 'user'=>$user, 'user_id' => $user_id, 'sign'=>$sign, 'hasTalk2' =>$hasTalk2, 'post2'=>$post2]);
    }
    public function sayYes(Request $request, $user_id, $post_id){
        if($request->ajax()) {
            
            $post = Applicant::where('user_id', $user_id)->update([
                'agreed' => 'Да'
            ]); 
            
            Comment::where('id', $post_id)->update([
                'status' => 4
            ]);

            return response()->json(['code' => 200, 'msg' => 'Вы согласны', 'user_id'=>$user_id]);
        }
    }
    public function sayNo(Request $request, $user_id, $post_id){
        if($request->ajax()) {
            
            $post = Applicant::where('user_id', $user_id)->update([
                'agreed' => 'Нет'
            ]); 

            Comment::where('id', $post_id)->update([
                'status' => 4
            ]);

            return response()->json(['code' => 200, 'msg' => 'Вы отказываетесь', 'user_id'=>$user_id]);
        }
    }

    public function attestate(Request $request, $user_id){
        if($request->ajax()) {
            
            $post = Applicant::where('user_id', $user_id)->update([
                'restatus_id' => 4
            ]); 

            
            return response()->json(['code' => 200, 'msg' => 'Вы согласны', 'user_id'=>$user_id]);
        }
    }

    public function retraine(Request $request, $user_id){
        if($request->ajax()) {
            
            $post = Applicant::where('user_id', $user_id)->update([
                'restatus_id' => 5
            ]); 
            
            return response()->json(['code' => 200, 'msg' => 'Вы согласны', 'user_id'=>$user_id]);
        }
    }
}
