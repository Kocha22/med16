<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicRequest;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Country;
use App\Models\Area;
use App\Models\Sending;
use App\Models\Cancel;
use App\Models\Practice;
use App\Models\Graduation;
use App\Models\Valid;
use App\Models\Addition;
use App\Models\Comment;
use App\Models\Contest;
use App\Models\Notemessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UnderConsideration;
use App\Mail\SendAgreement;
use App\Mail\SendApproved;
use App\Mail\SendCanceled;
use App\Mail\SendEdit;
use Carbon\Carbon;
use Validator;
use Auth;
use DB;
use Pusher\Pusher;
use Illuminate\Notifications\Notifiable;

class ApplicantController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts2 = DB::table('applicants')
            ->select('applicants.id', 'surname', 'name', 'middle', 'residential_address', 'dateofbirth', 'email', 'created_at', 'updated_at')
            ->where('appuserstatus_id', 5)
            ->orWhere('appuserstatus_id', 8);
        $posts = DB::table('applications')
             ->select('applications.id', 'surname', 'name', 'middle', 'residential_address', 'dateofbirth', 'email', 'created_at', 'updated_at')
             ->where('appuserstatus_id', 5)
             ->orWhere('appuserstatus_id', 8)
             ->union($posts2)
            ->get();
        return view('applicant', ['posts' => $posts, 'user'=>$user]);
    }
    public function contest()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts = Applicant::where('appuserstatus_id', 6 )->paginate(10);
        return view('contest', ['posts' => $posts,'user'=>$user]);
    }
    public function updatecontest(Request $request, $user_id){
        if($request->ajax()) {

            Applicant::where('user_id', $user_id)->update([
                'appuserstatus_id' => 6
            ]); 
            return response()->json(['code' => 200, 'msg' => 'Вы попали в резерв', 'user_id'=>$user_id]);
        }
    }
    public function allusers()
    {
                $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts = User::paginate(10);
        return view('users', ['posts' => $posts, 'user'=>$user]);
    }
    public function show($post_id)
    {
        if($post_id < 53) {
            $user_id=Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $post = Application::where('id', $post_id)->first();       
            $data = Practice::where('application_id', $post_id)->get();      
            $graduations = Graduation::where('application_id', $post_id)->get();
            $valid = Valid::where('application_id', $post_id)->first();
            $additions = Addition::where('application_id', $post_id)->get();
            return view('showappli', ['post'=> $post, 'data'=>$data, 'graduations'=>$graduations, 'valid'=>$valid, 'additions'=>$additions, 'user'=>$user]);
        } else {
            $data= Applicant::findOrFail($post_id)->educations;
            $data2= Applicant::findOrFail($post_id)->experiences;
            $data3= Applicant::findOrFail($post_id)->attestations;
            $data4= Applicant::findOrFail($post_id)->extras;
            $post = Applicant::where('id', $post_id)->first();
                    $user_id=Auth::user()->id;
            $user = User::where('id', $user_id)->first();
     
            return view('showapp', ['post'=> $post, 'data' => $data, 'data2'=>$data2, 'data3'=>$data3, 'data4'=>$data4, 'user'=>$user]);
        }
    }
    
    public function show2($post_id)
    {
        if($post_id < 53) {
            $user_id=Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $post = Application::where('id', $post_id)->first();       
            $data = Practice::where('application_id', $post_id)->get();      
            $graduations = Graduation::where('application_id', $post_id)->get();
            $valid = Valid::where('application_id', $post_id)->first();
            $additions = Addition::where('application_id', $post_id)->get();
            return view('showappli2', ['post'=> $post, 'data'=>$data, 'graduations'=>$graduations, 'valid'=>$valid, 'additions'=>$additions, 'user'=>$user]);
        } else {
            $data= Applicant::findOrFail($post_id)->educations;
            $data2= Applicant::findOrFail($post_id)->experiences;
            $data3= Applicant::findOrFail($post_id)->attestations;
            $data4= Applicant::findOrFail($post_id)->extras;
            $post = Applicant::where('id', $post_id)->first();
                    $user_id=Auth::user()->id;
            $user = User::where('id', $user_id)->first();
     
            return view('showapp2', ['post'=> $post, 'data' => $data, 'data2'=>$data2, 'data3'=>$data3, 'data4'=>$data4, 'user'=>$user]);
        }
    }

    public function showapfor($user_id)
    {
        $data= User::findOrFail($user_id)->usersed;
        $data2= User::findOrFail($user_id)->usersexp;
        $data3= User::findOrFail($user_id)->usersatt;
        $data4= User::findOrFail($user_id)->usersext;
        $post = Applicant::where('user_id', $user_id)->first();
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $comments = User::findOrFail($user_id)->comments;
 
        return view('showapfor', ['post'=> $post, 'data' => $data, 'data2'=>$data2, 'data3'=>$data3, 'data4'=>$data4, 'user'=>$user, 'user_id'=>$user_id, 'comments'=>$comments]);
    }
    public function create()
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }
        $user_id=Auth::user()->id;
        if(Applicant::where('user_id', $user_id)->exists()) {
            $user_id=Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $area= Area::root()->get();
            $countries=Country::get();
            $post = Applicant::where('user_id', $user_id)->first();
            $post_id = $post->id;

            $wordlist = Comment::where('user_to', $user_id)
                                ->where('read_at', '==', NULL)->get(); 
                                
            $offer = Comment::where('user_to', $user_id)
                     ->where('read_at', '==', NULL)
                     ->where('offer', 1)->get(); 
            
            $contest = Contest::where('read_at', '==', NULL)->get(); 

            if($post->notemessage()->where('applicant_id', $post_id)->exists()) {
                $attestateCount = 1;
            } else {
                $attestateCount = 0;
            }

            $contestCount = $contest->count();
            $offerCount=$offer->count(); 
            $wordCount = $wordlist->count();
            $total = $contestCount+$offerCount+$wordCount;

            return view('updateapp', ['user_id'=>$user_id,'countries'=>$countries, 'area'=>$area, 'user'=>$user, 'post'=>$post, 'wordCount' => $wordCount, 'contestCount'=>$contestCount, 'offerCount'=>$offerCount, 'total'=>$total, 'attestateCount' =>$attestateCount]);
        }

        $date = Carbon::now();// will get you the current date, time 
        $date2 = $date->format("Y-m-d"); 
        $countries=Country::get();
        $user = User::where('id', $user_id)->first();
        $area= Area::root()->get();
        $applicant_code = $this->generateUniqueCode();
        $post = Applicant::where('user_id', $user_id)->first();
        $post_id = $post->id;

        $wordlist = Comment::where('user_to', $user_id)
                            ->where('read_at', '==', NULL)->get();   

        $offer = Comment::where('user_to', $user_id)
        ->where('read_at', '==', NULL)
        ->where('offer', 1)->get(); 

        $contest = Contest::where('read_at', '==', NULL)->get(); 

        if($post->notemessage()->where('applicant_id', $post_id)->exists()) {
            $attestateCount = 1;
        } else {
            $attestateCount = 0;
        }

        $contestCount = $contest->count();
        $offerCount=$offer->count(); 
        $wordCount = $wordlist->count();
        $total = $contestCount+$offerCount+$wordCount;


        return view('createapplicant', ['user_id'=>$user_id,'date2'=> $date2, 'applicant_code' => $applicant_code, 'countries'=>$countries, 'area'=>$area, 'user'=>$user, 'post'=>$post, 'wordCount' => $wordCount, 'contestCount'=>$contestCount, 'offerCount'=>$offerCount, 'total'=>$total, 'attestateCount' =>$attestateCount]);
    }
    public function restore(Request $request, int $post_id)
    {
        $rules = [
            'tin' => 'digits:14',
            'surname' => 'required|regex:/^[А-Яа-яЁё]+$/u', 
            'middle' => 'required|regex:/^[А-Яа-яЁё]+$/u',            
            'name' => 'required|regex:/^[А-Яа-яЁё]+$/u',
            'address' => 'required',
            'oblast' => 'required',
            'rayon' => 'required',
            'address2' => 'required',
            'passport' => 'required',
            'phone' => 'required'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
         $post_data = $request->all('surname','middle','applicant_code', 'tin', 'name', 'dateofbirth', 'area_id','area_id2','residential_address','actual_address' ,'address','address2', 'passport',  'age', 'department', 'phone','oblast', 'rayon', 'city','oblast2', 'rayon2', 'city2', 'email', 'user_id');
         
         Applicant::where('id', $post_id)
              ->update($post_data);
         $user_id=Auth::user()->id;
 
         return response()->json(['code' => 200,'msg' => 'Письмо "На рассмотрений" отправлено заявителю.', 'user_id'=>$user_id]);
    }

    public function update2()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $area= Area::root()->get();
        $countries=Country::get();
        $post = Applicant::where('user_id', $user_id)->first();
        return view('updateapp', ['user_id'=>$user_id,'countries'=>$countries, 'area'=>$area, 'user'=>$user, 'post'=>$post]);
    }
    public function generateUniqueCode()
    {
        do {
            $applicant_code = random_int(100000, 999999);
        } while (Applicant::where("applicant_code", "=", $applicant_code)->first());
  
        return $applicant_code;
    }
    public function sendaction(Request $request, $user_id){
        if($request->ajax()) {
            
            $post = Applicant::where('user_id', $user_id)->update([
                'appuserstatus_id' => 14,
                'appstatus_id' => 5
            ]); 
            $post1 = Applicant::where('user_id', $user_id)->first();

            $note_id = Notemessage::findOrFail(1);

            $post1->notemessage()->attach($note_id);

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

            $data = ['user_to' => $user_id];
            $pusher->trigger('my-channel', 'my-eventAttestate', $data);

            return response()->json(['code' => 200, 'msg' => 'Отправлено на обучение/переподготовку', 'user_id'=>$user_id]);
        }
    }
    public function saction(Request $request, $user_id){
        if($request->ajax()) {
            
            $post = Applicant::where('user_id', $user_id)->update([
                'appuserstatus_id' => 8
            ]); 
            $post = Applicant::where('user_id', $user_id)->first();

            // $contest = Contest::all();

            // $post->contests()->attach($contest);

            return response()->json(['code' => 200, 'msg' => 'Ваша заявка подано', 'user_id'=>$user_id]);
        }
    }
    public function raction(Request $request, $post_id){
       if($request->ajax()) {
            if($post_id < 53) {
                $post = Application::where('id', $post_id)->first();
                $post_o = $post->appuserstatus_id;
            } else {
                $post = Applicant::where('id', $post_id)->first();
                $post_o = $post->appuserstatus_id;
            }            
            return response()->json(['post_id'=>$post_id, 'post_o'=>$post_o]);
        }
    }
    public function taction(Request $request, $post_id){
        if($request->ajax()) {
            Applicant::where('id', $post_id)->update([
                'appuserstatus_id' => 9
            ]); 
            $user_id=Auth::user()->id;
            return response()->json(['msg' => 'Редактировать данные', 'post_id'=>$post_id, 'user_id'=>$user_id]);
        }
    }
    public function search(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Area::where('name_ru', 'LIKE', "%$search%")
            		->get();
        }
        echo json_encode($data);
    }
    public function fraction(Request $request, $id)
    {
     if($request->ajax())
        $data=Area::with('children')->find($id);
        $user_id = Auth::user()->id;
        $post=Applicant::where('user_id', $user_id)->first();
        $output = '';
        $total_row=$data->children->count();
        if($total_row > 0){        
            $output = '<option value="">-- Выберите из списка --</option>';
            foreach($data->children as $row) {           
                $output .= '<option value='.$row->id.'  '.($row->id==$post->rayon ? ''.'selected'.'' : '').'  '.($row->id==$post->city ? ''.'selected'.'' : '').'  '.($row->id==$post->rayon2 ? ''.'selected'.'' : '').'  '.($row->id==$post->city2 ? ''.'selected'.'' : '').'>'.$row->name_ru.'</option>';
            }
        } else {
            $output = '';
        }

        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row
           );
        echo json_encode($data);
     }
     public function braction(Request $request, $id)
     {
      if($request->ajax())
         $data=Area::with('children')->find($id);
         $output = '';
         $total_row=$data->children->count();
         if($total_row > 0){
             $output = '<option value="">-- Выберите из списка --</option>';
             foreach($data->children as $row) {
                 $output .= '<option value='.$row->id.'>'.$row->name_ru.'</option>';
             }
         } else {
             $output = '';
         }
 
         $data = array(
             'table_data'  => $output,
             'total_data'  => $total_row
            );
         echo json_encode($data);
      }
     public function store(Request $request)
     {
        $rules = [
            'tin' => 'digits:16',
            'surname' => 'required|regex:/^[А-Яа-яЁё]+$/u', 
            'middle' => 'required|regex:/^[А-Яа-яЁё]+$/u',            
            'name' => 'required|regex:/^[А-Яа-яЁё]+$/u',
            'address' => 'required',
            'oblast' => 'required',
            'rayon' => 'required',
            'address2' => 'required',
            'passport' => 'required',
            'phone' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
         $post_data = $request->all('surname','middle','applicant_code', 'tin', 'name', 'dateofbirth', 'area_id','area_id2','residential_address','actual_address' ,'address','address2', 'passport',  'age', 'department', 'oblast', 'rayon', 'city','oblast2', 'rayon2', 'city2', 'phone', 'email', 'user_id');

         if(!empty($request->file)) {
            $file = $request->file('filename');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('avatars', $fileName);
            $post_data['filename']=$fileName;
        }
         
         $posts = Applicant::create($post_data);
         $user_id=Auth::user()->id;
         $posts->userspersonapp()->sync($user_id);
 
         return response()->json(['code' => 200,'msg' => 'Письмо "На рассмотрений" отправлено заявителю.', 'user_id'=>$user_id]);
     }
     
      public function download($file)
    {
        return response()->download(storage_path('app/avatars/' . $file));
    }
    
     public function consider(Request $request, int $post_id)
    {
          $rules = [
            'title' => 'required',
            'text' => 'required', 
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $posts = $request->all('title','text');

        $post_data = Cancel::create($posts);
        
        
        $post_data2 = Applicant::where('id', $post_id)->first();
        $user_id=Auth::user()->id;
        $to_mail2= $post_data2->email;
        Applicant::where('id', $post_id)->update([
            'appstatus_id' => 4
        ]); 
        Mail::to($to_mail2)->send(new UnderConsideration($post_data));
        Applicant::where('id', $post_id)->update([
            'appuserstatus_id' => 1
        ]);
        return response()->json(['code' => 200, 'msg' => 'Письмо "На рассмотрений" отправлено заявителю.', 'post_id'=>$post_id]);
        
       
    }
    
    public function approve(Request $request,int $post_id)
    {
        $rules = [
            'title' => 'required',
            'file' => 'required', 
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $posts = $request->all('title','file');

        $post_data = Sending::create($posts);

        $post_data2 = Applicant::where('id', $post_id)->first();
        $to_mail2= $post_data2->email;
        
        if ($post_id < 53) {
            Application::where('id', $post_id)->update([
                'appuserstatus_id' => 1
            ]);
         } else {
            Applicant::where('id', $post_id)->update([
                'appuserstatus_id' => 1
            ]);
         }

        Mail::to($to_mail2)->send(new SendApproved($post_data));
        return response()->json(['code' => 200, 'msg' => 'Письмо "Одобрено" отправлено заявителю.', 'post_id'=>$post_id]);
    }

    public function approveR(Request $request,int $post_id)
    {
        $rules = [
            'title' => 'required',
            'file' => 'required', 
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $posts = $request->all('title','file');

        $post_data = Sending::create($posts);

        $post_data2 = Applicant::where('id', $post_id)->first();
        $to_mail2= $post_data2->email;
        
        if ($post_id < 53) {
            Application::where('id', $post_id)->update([
                'appstatus_id' => 2
            ]);
         } else {
            Applicant::where('id', $post_id)->update([
                'appstatus_id' => 2
            ]);
         }

        Mail::to($to_mail2)->send(new SendApproved($post_data));
        return response()->json(['code' => 200, 'msg' => 'Письмо "Одобрено" отправлено заявителю.', 'post_id'=>$post_id]);
    }
    
    public function cancel(Request $request, int $post_id)
    {
         $rules = [
            'title' => 'required',
            'file' => 'required', 
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $posts = $request->all('title','file');

        $post_data = Sending::create($posts);
        
        $post_data2 = Applicant::where('id', $post_id)->first();
        $to_mail2= $post_data2->email;
        Applicant::where('id', $post_id)->update([
            'appuserstatus_id' => 11
        ]); 

        Mail::to($to_mail2)->send(new SendCanceled($post_data));
        return response()->json(['code' => 200, 'msg' => 'Письмо "Отказано" отправлено заявителю.', 'post_id'=>$post_id]);
    }

    public function edit(Request $request, int $post_id)
    {
        $rules = [
            'description' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $posts = $request->all('title', 'description');
        $post_data = Comment::create($posts);

        $post_data->user_from = Auth::user()->id;
        $post_data->save();

        Comment::where('id', $post_data->id)->update([
            'status' => 3
        ]); 
        
        $post_data2 = Applicant::where('id', $post_id)->first();
        $user_id2=$post_data2->user_id;
        $to_mail2= $post_data2->email;
        Applicant::where('id', $post_id)->update([
            'appuserstatus_id' => 13
        ]); 

        $post_data->user_to = $post_data2->user_id;
        $post_data->save();
        $id = $post_data->user_to;


        $post_data->userscomment()->sync($post_data2->user_id);        
        Mail::to($to_mail2)->send(new SendEdit($post_data));

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

        $data = ['user_to' => $id];
        $pusher->trigger('my-channel', 'my-event', $data);

        return response()->json(['code' => 200, 'msg' => 'Письмо "На редактировании" отправлено заявителю.', 'post_id'=>$post_id]);
    }   

    public function mark() {
        $posts = Comment::where('user_to', 62)->get();

        Comment::where('user_to', 62)->update([
            'read_at' => now()
        ]);

        return redirect()->route('updateapp');
 
    }
}
