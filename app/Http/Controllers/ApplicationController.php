<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicRequest;
use App\Models\Application;
use App\Models\Applicant;
use App\Models\Practice;
use App\Models\Graduation;
use App\Models\Valid;
use App\Models\Addition;
use App\Models\Area;
use App\Models\Country;
use App\Models\Sending;
use App\Models\Cancel;
use App\Models\Division;
use App\Models\Comment;
use App\Models\Position;
use App\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use App\Mail\UnderConsideration;
use App\Mail\SendApproved;
use App\Mail\SendCanceled;
use App\Mail\SendAgreement;
use App\Mail\SendTransaction;
use Carbon\Carbon;
use Validator;
use DB;
use Auth;
use Pusher\Pusher;

class ApplicationController extends Controller
{
    public function index() {
      $items='staff';
      $id = 1;
      return view('application', ['id'=>$id,'items'=>$items ]);
    }
      public function mainlist2(Request $request)
    {
     if($request->ajax())
     {
        $output = '';
        $batken="";
        $count2='';

        $output .= '';
       $post_id=1;
       $items = 'staff2';
       $data = array(
           'table_data'  => $output,
            'batken' => $batken,
           'items'=>$items,
           'post_id'=>$post_id,
            'count'=>$count2
          );

       echo json_encode($data);
      }
    }
    public function index5(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::paginate(10);
        $output = '';
        $batken="Резерв кадров";
        $total_row=$data->count();
        if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность/Статус</th>
          </tr>
          </thead>
          <tbody id="tbody">
            ';
           foreach($data as $row) {          
               $output .= '
               <tr>
                <td>'.$row->id.'</td>
                <td>'.$row->surname.' '.$row->name.' '. $row->middle.'</td>
                <td>'.$row->order.'</td>
                <td>'.$row->position.'</td>                
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }
       $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id
           );
       echo json_encode($data);
       }
    }
     public function appindex()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts2 = DB::table('applicants')
            ->join('appuserstatuses', 'applicants.appuserstatus_id', '=', 'appuserstatuses.id')
            ->select('applicants.id', 'applicants.surname', 'applicants.name', 'applicants.middle', 'applicants.order', 'applicants.position', 'applicants.updated_at', 'appuserstatuses.name as subjectName')
            ->where('appuserstatus_id', 1)
            ->orWhere('appuserstatus_id', 14)
            ->orWhere('appuserstatus_id', 15);
        $posts = DB::table('applications')
             ->join('appuserstatuses', 'applications.appuserstatus_id', '=', 'appuserstatuses.id')
             ->select('applications.id', 'applications.surname', 'applications.name', 'applications.middle', 'applications.order', 'applications.position', 'applications.updated_at', 'appuserstatuses.name as subjectName')
             ->where('appuserstatus_id', 1)
             ->orWhere('appuserstatus_id', 14)
             ->orWhere('appuserstatus_id', 15)
             ->union($posts2)
             ->orderBy('updated_at', 'DESC')
            ->get();
      
        $count= count($posts);
        return view('applicationinner', ['posts' => $posts, 'user'=>$user,'count'=>$count]);
    }
    public function archive()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts2 = DB::table('applicants')
            ->join('appuserstatuses', 'applicants.appuserstatus_id', '=', 'appuserstatuses.id')
            ->select('applicants.id', 'applicants.surname', 'applicants.name', 'applicants.middle', 'applicants.order', 'applicants.position', 'appuserstatuses.name as subjectName')
            ->where('appuserstatus_id', 11);
        $posts = DB::table('applications')
            ->join('appuserstatuses', 'applications.appuserstatus_id', '=', 'appuserstatuses.id')
            ->select('applications.id', 'applications.surname', 'applications.name', 'applications.middle', 'applications.order', 'applications.position', 'appuserstatuses.name as subjectName')
             ->where('appuserstatus_id', 11)
             ->union($posts2)
            ->get();
        return view('archive', ['posts' => $posts, 'user'=>$user]);
    }
      public function reserve()
    {
        $apps =true;
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
           $posts2 = DB::table('applicants')
            ->select('applicants.id', 'surname', 'name', 'middle', 'residential_address', 'dateofbirth', 'email')
            ->where('appuserstatus_id', 5);
        $posts = DB::table('applications')
             ->select('applications.id', 'surname', 'name', 'middle', 'residential_address', 'dateofbirth', 'email')
             ->where('appuserstatus_id', 5)
             ->union($posts2)
            ->get();
        return view('applicationreserve', ['posts' => $posts, 'user'=>$user, 'apps'=>$apps]);
    }
    public function appindexatt()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts2 = DB::table('applicants')
        ->join('appuserstatuses', 'applicants.appuserstatus_id', '=', 'appuserstatuses.id')
        ->select('applicants.id', 'applicants.surname', 'applicants.name', 'applicants.middle', 'applicants.residential_address', 'applicants.score_attestation', 'applicants.score_relearning','applicants.rating', 'applicants.updated_at', 'appuserstatuses.name as subjectName')
        ->where('appstatus_id', 2)
        ->orWhere('appuserstatus_id', 14)
        ->orWhere('appuserstatus_id', 15)
        ->orWhere('appuserstatus_id', 3)
        ->orWhere('appuserstatus_id', 16);
        $posts = DB::table('applications')
        ->join('appuserstatuses', 'applications.appuserstatus_id', '=', 'appuserstatuses.id')
        ->select('applications.id', 'applications.surname', 'applications.name', 'applications.middle', 'applications.residential_address', 'applications.score_attestation', 'applications.score_relearning','applications.rating', 'applications.updated_at', 'appuserstatuses.name as subjectName')
         ->where('appstatus_id', 2)
         ->orWhere('appuserstatus_id', 14)
         ->orWhere('appuserstatus_id', 15)
         ->orWhere('appuserstatus_id', 16)
         ->orWhere('appuserstatus_id', 3)
         ->union($posts2)
         ->orderBy('updated_at', 'DESC')
        ->get();    
  
        return view('applicationattestation', ['posts' => $posts, 'user'=>$user]);
    }

    public function study()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts2 = DB::table('applicants')
        ->join('restatuses', 'applicants.restatus_id', '=', 'restatuses.id')
        ->select('applicants.id', 'applicants.surname', 'applicants.name', 'applicants.middle', 'applicants.residential_address', 'applicants.score_attestation', 'applicants.score_relearning','applicants.rating', 'applicants.updated_at', 'restatuses.name as subjectName')
        ->where('restatus_id', 4);
        $posts = DB::table('applications')
        ->join('restatuses', 'applications.restatus_id', '=', 'restatuses.id')
        ->select('applications.id', 'applications.surname', 'applications.name', 'applications.middle', 'applications.residential_address', 'applications.score_attestation', 'applications.score_relearning','applications.rating', 'applications.updated_at', 'restatuses.name as subjectName')
         ->where('restatus_id', 4)
         ->union($posts2)
         ->orderBy('updated_at', 'DESC')
        ->get();    
  
        return view('study', ['posts' => $posts, 'user'=>$user]);
    }

    public function retraine()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts2 = DB::table('applicants')
        ->join('restatuses', 'applicants.restatus_id', '=', 'restatuses.id')
        ->select('applicants.id', 'applicants.surname', 'applicants.name', 'applicants.middle', 'applicants.residential_address', 'applicants.score_attestation', 'applicants.score_relearning','applicants.rating', 'applicants.updated_at', 'restatuses.name as subjectName')
        ->where('restatus_id', 5);
        $posts = DB::table('applications')
        ->join('restatuses', 'applications.restatus_id', '=', 'restatuses.id')
        ->select('applications.id', 'applications.surname', 'applications.name', 'applications.middle', 'applications.residential_address', 'applications.score_attestation', 'applications.score_relearning','applications.rating', 'applications.updated_at', 'restatuses.name as subjectName')
         ->where('restatus_id', 5)
         ->union($posts2)
         ->orderBy('updated_at', 'DESC')
        ->get();    
  
        return view('retraining', ['posts' => $posts, 'user'=>$user]);
    }
    
    public function update($id)
    {
        if (Application::where('id', '=', $id)->exists()) {
            $data = Application::find($id);
         } else {
            $data = Applicant::find($id);
         }
    	

	    return response()->json([
	      'data' => $data
	    ]);
    }
    
    public function edit(Request $request, $id)
    {
        if (Application::where('id', '=', $id)->exists()) {
            if($request->score_attestation > 55 ){
                Application::updateOrCreate(
                    [
                     'id' => $id
                    ],
                    [
                     'score_attestation' => $request->score_attestation,
                     'score_relearning' => $request->score_relearning,
                     'rating' => $request->rating,
                     'appuserstatus_id' => 15
                    ]
                   );
            } else {
                Application::updateOrCreate(
                    [
                     'id' => $id
                    ],
                    [
                     'score_attestation' => $request->score_attestation,
                     'score_relearning' => $request->score_relearning,
                     'rating' => $request->rating,
                     'appuserstatus_id' => 16
                    ]
                   );
            }
            
         } else {
            if($request->score_attestation > 55 ){
                Applicant::updateOrCreate(
                    [
                     'id' => $id
                    ],
                    [
                     'score_attestation' => $request->score_attestation,
                     'score_relearning' => $request->score_relearning,
                     'rating' => $request->rating,
                     'appuserstatus_id' => 15
                    ]
                   );
            } else {
                Applicant::updateOrCreate(
                [
                 'id' => $id
                ],
                [
                 'score_attestation' => $request->score_attestation,
                 'score_relearning' => $request->score_relearning,
                 'rating' => $request->rating,
                 'appuserstatus_id' => 16              
                ]
               );
            }
         }
      

      return response()->json([ 'success' => true ]);

    }
    
     public function offer()
    {
        $date = Carbon::now();// will get you the current date, time 
        $date2 = $date->format("Y-m-d"); 
        $department=Department::get();
        $position=Position::get();

        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts2 = DB::table('applicants')
        ->select('applicants.id', 'surname', 'name', 'middle', 'dateofbirth','residential_address', 'rating', 'agreed', 'appuserstatus_id')
        ->where('restatus_id', 2)
        ->orWhere('appuserstatus_id', 3)
        ->orWhere('appuserstatus_id', 14)
        ->orWhere('appuserstatus_id', 15);
        $posts = DB::table('applications')
         ->select('applications.id', 'surname', 'name', 'middle','dateofbirth', 'residential_address', 'rating', 'agreed', 'appuserstatus_id')
         ->where('restatus_id', 2)
         ->orWhere('appuserstatus_id', 14)
         ->orWhere('appuserstatus_id', 15)
         ->orWhere('appuserstatus_id', 3)
         ->union($posts2)
         ->orderBy('rating','DESC')->limit(2)->get();

        $c=[];
       
        foreach ($posts as $post ) 
        {
            $c[] = $post->agreed;                   
        }

        if($c[0] == $c[1] && $c[0] != NULL && $c[1]!=NULL) {
            $yes = 1;
        } elseif($c[0] == 'Нет' && $c[1]==NULL) {
            $yes = 2;
        } elseif($c[0] == 'Нет' && $c[1]=='Да') {
            $yes = 3;
        } else {
            $yes = 4;
        }

        return view('offer', ['posts' => $posts, 'user'=>$user, 'date2'=>$date2, 'position'=>$position, 'department'=>$department, 'yes'=>$yes]);
    }
     public function showagreement()
    {
                $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $posts = Application::where('appstatus_id', 5)->get();
        return view('agreement', ['posts' => $posts, 'user'=>$user]);
    }
    public function restore($id)
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if (Application::where('id', '=', $id)->exists()) {
            Application::where('id', $id)->update([
                'restatus_id' => 2
            ]);
         } else {
            Applicant::where('id', $id)->update([
                'restatus_id' => 2
            ]);
         }

        return response()->json([ 'success' => true ]);

    }
    public function restorereserve($id)
    {
        if (Application::where('id', '=', $id)->exists()) {
            Application::where('id', $id)->update([
                'appuserstatus_id' => 1
            ]);
         } else {
            Applicant::where('id', $id)->update([
                'appuserstatus_id' => 1
            ]);
         }
        
         
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        return back();

    }
    public function show(int $post_id)
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


    public function create()
    {
                $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $date = Carbon::now();// will get you the current date, time 
        $date2 = $date->format("Y-m-d"); 
        $countries=Country::get();
        $area= Area::root()->get();
        $applicant_code = $this->generateUniqueCode();
        return view('createapplication', ['date2'=> $date2, 'applicant_code' => $applicant_code, 'countries'=>$countries, 'area'=>$area, 'user'=>$user]);
    }
    public function generateUniqueCode()
    {
        do {
            $applicant_code = random_int(100000, 999999);
        } while (Application::where("application_code", "=", $applicant_code)->first());
  
        return $applicant_code;
    }
    public function fraction(Request $request, $id)
    {
     if($request->ajax())
        $data=Area::with('children')->find($id);
        $output = '<option value="">-- Выберите из списка --</option>';
        $total_row=$data->children->count();
        if($total_row > 0){
            foreach($data->children as $row) {
                $output .= '<option value='.$row->id.'>'.$row->name_ru.'</option>';
            }
        } else {
            $output = '<option value="">-- Нет данных --</option>';
        }

        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row
           );
        echo json_encode($data);
     }
     public function store(ApplicRequest $request)
     {
         $post_data = $request->except(['surname','middle','dateofbirth','actual_address','jobphone','mobilephone','order','dateoforder','jobdate','termination','oblast_id','city_id','appstatus_id']);
         
         $posts = Application::create($post_data);
 
         dd($posts);
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
        
        
        $post_data2 = Application::where('id', $post_id)->first();
        $to_mail2= $post_data2->email;
        Application::where('id', $post_id)->update([
            'appstatus_id' => 4
        ]); 
        Mail::to($to_mail2)->send(new UnderConsideration($post_data));
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
        
        
        $post_data2 = Application::where('id', $post_id)->first();
        $to_mail2= $post_data2->email;
        if ($post_id < 53) {
            Application::where('id', $post_id)->update([
                'appstatus_id' => 2,
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
        
        
        $post_data2 = Application::where('id', $post_id)->first();
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
        
        
        $post_data2 = Application::where('id', $post_id)->first();
        $to_mail2= $post_data2->email;
        Application::where('id', $post_id)->update([
            'appuserstatus_id' => 11
        ]); 

        Mail::to($to_mail2)->send(new SendCanceled($post_data));
        return response()->json(['code' => 200, 'msg' => 'Письмо "Отказано" отправлено заявителю.', 'post_id'=>$post_id]);
    }
    public function update23($id)
    {
        if (Applicant::where('id', $id)->exists()) {
            $data = Applicant::findOrFail($id);
         } else {
            $data = Application::findOrFail($id);
         }
    	

	    return response()->json([
	      'data' => $data
	    ]);
    }
    
    public function store23(Request $request, $post_id)
    {
        if(Applicant::where('id', $post_id)->exists()) {
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
                'status' => 2
            ]);
            
            $post_data2 = Applicant::where('id', $post_id)->first();
            $post_data->userscomment()->sync($post_data2->user_id);

            $post_data->user_to = $post_data2->user_id;
            $post_data->save();

            $to_mail2= $post_data2->email;
            Applicant::where('id', $post_id)->update([
                'appuserstatus_id' => 3
            ]); 
            Mail::to($to_mail2)->send(new SendTransaction($post_data));  

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

            $data = ['user_to' => $post_data2->user_id];
            $pusher->trigger('my-channel', 'my-eventOffer', $data);

            return response()->json(['code' => 200, 'msg' => 'Письмо с предложение перевода отправлено на почту.', 'post_id'=>$post_id]);
        } else {
            $rules = [
                'description' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
            }

            $posts = $request->all('title', 'description');
            $post_data = Comment::create($posts);

            $post_data2 = Application::where('id', $post_id)->first();
            $to_mail2= $post_data2->email;
            Application::where('id', $post_id)->update([
                'appuserstatus_id' => 14
            ]);        
            Mail::to($to_mail2)->send(new SendTransaction($post_data)); 

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

            $data = ['user_to' => $post_data2->user_id];
            $pusher->trigger('my-channel', 'my-event', $data);
            return response()->json(['code' => 200, 'msg' => 'Письмо с предложение перевода отправлено на почту.']);
        }

    }
     public function sendagreement(Request $request, int $post_id)
    {
        if ($post_id > 53) {
            $rules = [
                'description' => 'required',
            ];
        
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
            }
            $posts = $request->all('title', 'description');
            $post_data = Comment::create($posts);
            
            $post_data2 = Application::where('id', $post_id)->first();
            $to_mail2= $post_data2->email;
            Application::where('id', $post_id)->update([
                'appuserstatus_id' => 5
            ]); 
            Mail::to($to_mail2)->send(new SendTransaction($post_data));
            return response()->json(['code' => 200, 'msg' => 'Письмо с предложение перевода отправлено на почту.', 'post_id'=>$post_id]);

         } else {
            $rules = [
                'description' => 'required',
            ];
        
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
            }
            $posts = $request->all('title', 'description');
            $post_data = Comment::create($posts);
            
            $post_data2 = Applicant::where('id', $post_id)->first();
            $to_mail2= $post_data2->email;
            Applicant::where('id', $post_id)->update([
                'appuserstatus_id' => 5
            ]); 
            $post_data->userscomment()->sync($post_data2->user_id);
            Mail::to($to_mail2)->send(new SendTransaction($post_data));
            return response()->json(['code' => 200, 'msg' => 'Письмо с предложение перевода отправлено на почту.', 'post_id'=>$post_id]);
         }
    }
    
     function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = Application::where('name', 'like', '%'.$query.'%')
         ->orWhere('surname', 'like', '%'.$query.'%')
         ->orWhere('middle', 'like', '%'.$query.'%')
         ->orderBy('id', 'asc')
         ->paginate(10);
         
      }
      else
      {
       $data = Application::orderBy('id', 'asc') ->paginate(10);
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->id.'</td>
         <td>'.$row->surname.' ' . $row->name.' ' . $row->middle.'</td>
         <td>'.$row->dateofbirth.'</td>
         <td>'.$row->residential_address.'</td>
         <td>'.$row->appstatuses->name.'</td>
         <td>
         <div class="action_icons">
         <a href="/showap/'.$row->id.'">'.'<input type="submit" title="Показать" class="eye-icon">'.'</a>'.
         '</div>
        </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="6">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }   



    public function republic(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 1)->paginate(10);
        $output = '';
        $batken="Организации Республиканского значения";
        $total_row=$data->count();
        if($total_row > 0){
          $output .= '
          <thead>
          <tr>
          <th>№</th>
          <th>ФИО</th>
          <th>Текущее место работы</th>
          <th>Должность</th>
          </tr>
          </thead>
          <tbody id="tbody">
          ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->id.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>  
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }

             $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id
           );
       echo json_encode($data);
       }
    }
    public function batkenoblast(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 3)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken = 'Организации Баткенской области';
        $total_row=$data->count();
        if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->number.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>  
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }

       $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    public function bishkek(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 2)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации г.Бишкек";
        $total_row=$data->count();
        if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->number.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>  
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }

         $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    public function osh(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 8)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации г.Ош";
        $total_row=$data->count();
        if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->number.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>  
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }

            $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    public function oshoblast(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 7)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации Ошской области";
        $total_row=$data->count();
        if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->number.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>  
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }

             $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    public function djalaloblast(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 4)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации Джалал-Абадской области";
        $total_row=$data->count();
        if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->number.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>  
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }
       $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    public function narynoblast(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 6)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации Нарынской области";
        $total_row=$data->count();
        if($total_row > 0){
             $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->number.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>  
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }

        $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    public function chuioblast(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 10)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации Чуйской области";
        $total_row=$data->count();
        if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->number.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>  
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }

           $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    public function talasoblast(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 9)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации Таласской области";
        $total_row=$data->count();
        if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Текущее место работы</th>
            <th>Должность</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $output .= '
               <tr>
               <td>'.$row->number.'</td>
               <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
               <td>'.$row->order.'</td>
               <td>'.$row->position.'</td>   
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }

         $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    public function issykoblast(Request $request)
    {
     if($request->ajax())
     {
        $data= Application::where('division_id', 5)->paginate(10);
         $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации Иссык-Кульской области";
        $total_row=$data->count();
        if($total_row > 0){
          $output .= '
          <thead>
          <tr>
          <th>№</th>
          <th>ФИО</th>
          <th>Текущее место работы</th>
          <th>Должность</th>
          </tr>
          </thead>
          <tbody id="tbody">
          ';
           foreach($data as $row) {
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->surname.' '.$row->name.' '.$row->middle.'</td>
                <td>'.$row->order.'</td>
                <td>'.$row->position.'</td>                
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="8">No Data Found</td>
      </tr>
      ';
       }
       $post_id=1;
        $items = 'mainlist';
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row,
            'batken' => $batken,
            'items'=>$items,
            'post_id'=>$post_id,
            'count'=>$count2
           );
       echo json_encode($data);
       }
    }
    
}
