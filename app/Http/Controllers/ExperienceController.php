<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Experience;
use App\Models\Applicant;
use App\User;
use App\Http\Requests\ExperienceRequest;
use Validator;

class ExperienceController extends Controller
{
    public function create($user_id) 
    {
    $post = Applicant::where('user_id', $user_id)->first();
    $user = User::where('id', $user_id)->first();
    $organizations = Organization::get();
    $positions = Position::get();
    return view('createexperience', ['organizations' => $organizations, 'positions' => $positions, 'user_id' =>$user_id, 'user'=>$user, 'post'=>$post]);
    }

    public function store(Request $request)
     {
         $rules = [
            'organization_id' => 'required',
            'position_id' => 'required',
            'jobdate' => 'required',
            'warrant' => 'required_if:nowadays,==,1',
            'date_order' => 'required_if:nowadays,==,1',
            'begindate' => 'required_if:nowadays,==,1',
            'enddate' => 'required_if:nowadays,==,1'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['code'=>'401', 'msg'=> $validator->errors()->toArray()]);
        }
        $post_data = $request->all('organization_id', 'position_id', 'jobdate', 'termination', 'warrant', 'date_order', 'begindate', 'enddate');
        
        $posts = Experience::create($post_data);
        $user_id=$request->user_id;
        $posts->users()->sync($user_id);
    
        return response()->json(['code' => 200, 'msg' => 'Успешно добавлено']);
     }

     public function update($id)
     {
         if (Experience::where('id', '=', $id)->exists()) {
             $data = Experience::findOrFail($id);
          } else {
             $data = Experience::findOrFail($id);
          }
         
 
         return response()->json([
           'data' => $data
         ]);
     }
     
     public function edit(Request $request, $id)
     {
         if (Experience::where('id', '=', $id)->exists()) {
            Experience::updateOrCreate(
                 [
                  'id' => $id
                 ],
                 [
                  'jobdate' => $request->jobdate,
                  'termination' => $request->termination
                 ]
                );
          } else {
            Experience::updateOrCreate(
                 [
                  'id' => $id
                 ],
                 [
                     'nameoforganization' => $request->jobdate,
                     'faculty' => $request->termination
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
          $data= User::findOrFail($user_id)->usersexp;  
          $total_row=$data->count();
          if($total_row > 0){
             foreach($data as $row) {
                 $output .= '
                 <tr>
                  <td>'.$row->organizations->name.'</td>
                  <td>'.$row->positions->name.'</td>
                  <td>'.$row->jobdate.'</td>
                  <td>'.$row->termination.'</td>
                  <td>'.$row->warrant.'</td>
                  <td>'.$row->begindate.'</td>
                  <td>'.$row->enddate.'</td>
                  <td>
                  <div class="action_icons">
                  <button id="editCompany" type="button" data-toggle="modal" data-id='.$row->id.'  data-target="#practice_modal"  class="draw-icon">'.'</button>
                  <button class="delete-icon" data-sid='.$row->id.'">'.'</button>                
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
     public function delete($post_id)
     {
        $posts =Experience::find($post_id); 
        $posts->appexperience()->detach();
        $posts->delete();
 
         return response()->json(['msg' => 'Удалено.']);
     }
}
