<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciality;
use App\Models\Typeofeducation;
use App\Models\Education;
use App\Models\KindEducation;
use App\Models\Applicant;
use App\Models\Scan;
use App\Models\Formation;
use App\User;
use App\Http\Requests\EducationRequest;
use Validator;

class FormationController extends Controller
{
    public function create($user_id) 
    {
    $user = User::where('id', $user_id)->first();
    $typeofeducation = Typeofeducation::get();
    $specialities = Speciality::get();
    $kinds = KindEducation::get();
    $post = Applicant::where('user_id', $user_id)->first();
    return view('createformation', ['typeofeducation' => $typeofeducation, 'specialities' => $specialities, 'user_id'=>$user_id, 'kinds'=>$kinds, 'user'=>$user, 'post'=>$post]);
    }

    public function store(Request $request)
     {
     $rules = [
        'nameoforganization' => 'required',
    ];

    $validator = Validator::make($request->except(['user_id', 'filename','kind_education_id']), $rules);
    if ($validator->fails()) {
        return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
    }
    $post_data = $request->except(['user_id']);

    if(!empty($request->file)) {
        $file = $request->file('filename');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('avatars', $fileName);
        $post_data['filename']=$fileName;
    }
    

    $posts = Formation::create($post_data);
    $user_id=$request->user_id;
    $posts->users()->sync($user_id);

    return response()->json(['code' => 200, 'msg' => 'Успешно добавлено']);
    }

    public function update($id)
    {
        if (Formation::where('id', '=', $id)->exists()) {
            $data = Formation::findOrFail($id);
         } else {
            $data = Formation::findOrFail($id);
         }
    	

	    return response()->json([
	      'data' => $data
	    ]);
    }
    
    public function edit(Request $request, $id)
    {
        if (Formation::where('id', '=', $id)->exists()) {
            Formation::updateOrCreate(
                [
                 'id' => $id
                ],
                [
                 'nameoforganization' => $request->nameoforganization,
                 'faculty' => $request->faculty
                ]
               );
         } else {
            Formation::updateOrCreate(
                [
                 'id' => $id
                ],
                [
                    'nameoforganization' => $request->nameoforganization,
                    'faculty' => $request->faculty
                ]
               );
         }
      

      return response()->json([ 'success' => true ]);

    }

    public function ajaxproduction(Request $request, $user_id)
    {
        if($request->ajax())
        {         
         $output = '';  
         $data= User::findOrFail($user_id)->usersformation;       

         $total_row=$data->count();
         if($total_row > 0){
            foreach($data as $row) {
                $output .= '
                <tr>
                 <td>'.$row->kindeducations->name.'</td>
                 <td>'.$row->nameoforganization.'</td>
                <td>'.($row->kindeducations->id==1 ? ''.$row->specialities->name.'' : '') .'</td>                             
                <td>'.$row->dateofentry.'</td>
                 <td>'.$row->termination.'</td>                
                <td>'.($row->kindeducations->id==2 ? ''.$row->professions->name.'' : '').'</td>
                <td>'.($row->filename ?? "").'</td>
                 <td>
                 <div class="action_icons">  
                 <button id="editCompany" type="button" data-toggle="modal" data-id='.$row->id.'  data-target="#practice_modal"  class="draw-icon">'.'</button>            
                <button class="delete-icon" data-sid='.$row->id.'>'.'</button>
                </div>
                </td>
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

        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row
           );
        echo json_encode($data);
        }
    }
    public function kindeducation(Request $request, $id)
    {
        if($request->ajax())
        {         
         $output = '';  
         if($id==1) {
            $data= Speciality::where('kind_education_id',$id)->get();
            $total_row=$data->count();
            $label="Клиническая ординатура";
         } elseif ($id==2){
            $data= Profession::where('kind_education_id',$id)->get();
            $total_row=$data->count();
            $label="Специальноть";
         } else {
            $total_row = 0;
            $label ='';
         }
                
         $output = '';
         
         if($total_row > 0){
             $output = '<option value="">-- Выберите из списка --</option>';
             foreach($data as $row) {
                 $output .= '<option value='.$row->id.'>'.$row->name.'</option>';
             }
         } else {
             $output = '';
         }
 
         $data = array(
             'table_data'  => $output,
             'total_data'  => $total_row,
             'label' => $label
            );
         echo json_encode($data);
        }
    }
    public function delete($post_id)
    {
        $posts =Formation::find($post_id); 
        $posts->users()->detach();
        $posts->delete();

        return response()->json(['msg' => 'Удалено.']);
    }
}