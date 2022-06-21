<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Department;
use App\Models\Organization;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\User;
use Auth;

class OrganizationController extends Controller
{
    public function index5(Request $request) {
      $items='mainlist';
      $id = 1;
      return view('organization2', ['id'=>$id, 'items'=>$items]);
    }
    public function mainlist(Request $request)
    {
     if($request->ajax())
     {
        $output = '';
        $batken="";
        $count2= '';
        
        $output .= '';
       $post_id=1;
       $items = 'main';
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
    public function index(Request $request)
    {
      if($request->ajax())
      {
         $data= Department::paginate(10);
         $output = '';
         $batken = "Организации здравоохранения";
         $total_row=$data->count();
         if($total_row > 0){
            $output .= '
            <thead>
            <tr>
            <th>№</th>
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
            foreach($data as $row) {
                $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
                $output .= '
                <tr>
                 <td>'.$row->number.'</td>
                 <td>'.$row->name.'</td>
                 <td>'.$row->director.'</td>
                 <td>'.$row->address.'</td>                
                 <td>'.$r2.'</td>
                 <td>
                 <div class="button-submit"> 
                    <a class="btn_red red" href="#">Подробнее</a>
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
    public function republic(Request $request)
    {
     if($request->ajax())
     {
        $data= Department::where('division_id', 1)->get();
        $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации Республиканского значения";
        $total_row=$data->count();
        if($total_row > 0){
          $output .= '
          <thead>
          <tr>
          <th>№</th>
          <th>Наименование организации здравоохранения</th>
          <th>Руководитель</th>
          <th>Адрес</th>
          <th>Контакты</th>
          <th>Данные о регистрации</th>
          </tr>
          </thead>
          <tbody id="tbody">
          ';
           foreach($data as $row) {
               $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                    <a class="btn_red red" href="#">Подробнее</a>
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
    public function batkenoblast(Request $request)
    {
     if($request->ajax())
     {
        $data= Department::where('division_id', 3)->get();
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
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $r=$row->contact;
               $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                    <a class="btn_red red" href="#">Подробнее</a>
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
        $data= Department::where('division_id', 2)->get();
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
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
                $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                  <a class="btn_red red" href="#">Подробнее</a>
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
        $data= Department::where('division_id', 8)->get();
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
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                <a class="btn_red red" href="#">Подробнее</a>
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
        $data= Department::where('division_id', 7)->get();
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
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                    <a class="btn_red red" href="#">Подробнее</a>
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
        $data= Department::where('division_id', 4)->get();
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
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                    <a class="btn_red red" href="#">Подробнее</a>
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
        $data= Department::where('division_id', 6)->get();
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
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                 <td>
                 <div class="button-submit"> 
                 <a class="btn_red red" href="#">Подробнее</a>
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
        $data= Department::where('division_id', 10)->get();
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
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
               $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                <a class="btn_red red" href="#">Подробнее</a>
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
        $data= Department::where('division_id', 9)->get();
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
            <th>Наименование организации здравоохранения</th>
            <th>Руководитель</th>
            <th>Адрес</th>
            <th>Контакты</th>
            <th>Данные о регистрации</th>
            </tr>
            </thead>
            <tbody id="tbody">
            ';
           foreach($data as $row) {
                $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                <a class="btn_red red" href="#">Подробнее</a>
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
        $data= Department::where('division_id', 5)->get();
             $count= $data->count();
        $count2= 'Количество записей: '.$count;
        $output = '';
        $batken="Организации Иссык-Кульской области";
        $total_row=$data->count();
        if($total_row > 0){
          $output .= '
          <thead>
          <tr>
          <th>ID</th>
          <th>Наименование организации здравоохранения</th>
          <th>Руководитель</th>
          <th>Адрес</th>
          <th>Контакты</th>
          <th>Данные о регистрации</th>
          </tr>
          </thead>
          <tbody id="tbody">
          ';
           foreach($data as $row) {
               $r=$row->contact;
                $r2=str_replace("\r\n", "<br />", $r);
               $output .= '
               <tr>
                <td>'.$row->number.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->director.'</td>
                <td>'.$row->address.'</td>                
                <td>'.$r2.'</td>
                <td>
                <div class="button-submit"> 
                    <a class="btn_red red" href="#">Подробнее</a>
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
    
    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = Organization::where('name', 'like', '%'.$query.'%')
         ->orderBy('id', 'asc')
         ->paginate(10);
         
      }
      else
      {
       $data = Organization::orderBy('id', 'asc') ->paginate(10);
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->id.'</td>
         <td>'.$row->name.'</td>
         <td>'.$row->tin.'</td>
        </tr>
        ';
       }
      }
      else
      {
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
}
