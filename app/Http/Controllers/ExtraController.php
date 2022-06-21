<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\Extra;
use App\Models\Applicant;
use App\User;
use Illuminate\Http\Request;
use Validator;

class ExtraController extends Controller
{
    public function create($user_id) 
    {
        $post = Applicant::where('user_id', $user_id)->first();
        $user = User::where('id', $user_id)->first();
    return view('createextra', ['user_id' =>$user_id, 'user'=>$user, 'post'=>$post ]);
    }

    public function store(Request $request)
    {
    $rules = [
       'text' => 'required',
       'typeofextra' => 'required',
       'file' => 'required',
       'dateofdocument' => 'required',
       'description' => 'required'
   ];

   $validator = Validator::make($request->except(['user_id']), $rules);
   if ($validator->fails()) {
       return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
   }
   $post_data = $request->all('text', 'typeofextra', 'file', 'dateofdocument', 'description');
    if(!empty($request->file)) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('avatars', $fileName);
        $post_data['file']=$fileName;
    }
   
   $posts = Extra::create($post_data);
   $user_id=$request->user_id;
   $posts->users()->sync($user_id);

   return response()->json(['code' => 200, 'msg' => 'Успешно добавлено']);
   }

   public function update($id)
   {
       if (Extra::where('id', '=', $id)->exists()) {
           $data = Extra::findOrFail($id);
        } else {
           $data = Extra::findOrFail($id);
        }
       

       return response()->json([
         'data' => $data
       ]);
   }
   
   public function edit(Request $request, $id)
   {
       if (Extra::where('id', '=', $id)->exists()) {
        Extra::updateOrCreate(
               [
                'id' => $id
               ],
               [
                'text' => $request->text,
                'typeofextra' => $request->typeofextra,
                'file' => $request->file,
                'dateofdocument' => $request->dateofdocument,
                'description' => $request->description
               ]
              );
        } else {
            Extra::updateOrCreate(
               [
                'id' => $id
               ],
               [
                'text' => $request->text,
                'typeofextra' => $request->typeofextra,
                'file' => $request->file,
                'dateofdocument' => $request->dateofdocument,
                'description' => $request->description
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
        $data= User::findOrFail($user_id)->usersext;       

        $total_row=$data->count();
        if($total_row > 0){
           foreach($data as $row) {
               $output .= '
               <tr>
                <td>'.$row->text.'</td>
                <td>'.$row->typeofextra.'</td>
                <td>'.$row->file.'</td>
                <td>'.$row->dateofdocument.'</td>
                <td>'.$row->description.'</td>
                <td>
                <div class="action_icons">
                <button id="editCompany" type="button" data-toggle="modal" data-id='.$row->id.'  data-target="#practice_modal"  class="draw-icon">'.'</button>          
               <button class="delete-icon" data-sid='.$row->id.'>'.'</button>'.
                '</div>
               </td>
               </tr>
               ';
           }
       } else {
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
   public function delete($post_id)
   {
       $posts =Extra::find($post_id); 
       $posts->users()->detach();
       $posts->delete();

       return response()->json(['msg' => 'Удалено.']);
   }

}
