<?php

namespace App\Http\Controllers;

use App\Models\Typeofdocument;
use App\Models\Qualification;
use App\Models\Attestation;
use App\Models\Applicant;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;

class AttestationController extends Controller
{
    public function create($user_id) 
    {
        $user = User::where('id', $user_id)->first();
    $type = Typeofdocument::get();
    $positions = Qualification::get();
    return view('createattestation', ['type' => $type, 'positions' => $positions, 'user_id' =>$user_id, 'user'=>$user]);
    }

    public function store(Request $request)
    {
    $rules = [
       'dateofentry' => 'required',
       'qualification_id' => 'required',
       'careertarget' => 'required',
       'careergrowth' => 'required',
       'typeofdocument_id' => 'required',
       'nameofdocument' => 'required'
   ];

   $validator = Validator::make($request->except(['applicant_id']), $rules);
   if ($validator->fails()) {
       return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
   }
   $post_data = $request->all('dateofentry', 'qualification_id', 'careertarget', 'careergrowth', 'typeofdocument_id', 'nameofdocument', 'file');
    if(!empty($request->file)) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('avatars', $fileName);
        $post_data['file']=$fileName;
    }
   
   $posts = Attestation::create($post_data);
   $user_id=$request->user_id;
   $posts->users()->sync($user_id);

   return response()->json(['code' => 200, 'msg' => 'Успешно добавлено']);
   }

   public function ajaxproduction(Request $request, $user_id)
   {
       if($request->ajax())
       {         
        $output = '';  
        $data= User::findOrFail($user_id)->usersatt;       

        $total_row=$data->count();
        if($total_row > 0){
           foreach($data as $row) {
               $output .= '
               <tr>
                <td>'.$row->typeofdocuments->name.'</td>
                <td>'.$row->nameofdocument.'</td>
                <td>'.$row->file.'</td>
                <td>
                <div class="action_icons">             
               <button class="delete-icon" data-sid='.$row->id.'>'.'</button>'.
                '</div>
               </td>
               </tr>
               ';
           }
       } else {
           $output = '
      <tr>
       <td align="center" colspan="4">No Data Found</td>
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
   public function delete($post_id)
   {
       $posts =Attestation::find($post_id); 
       $posts->users()->detach();
       $posts->delete();

       return response()->json(['msg' => 'Удалено.']);
   }

}
