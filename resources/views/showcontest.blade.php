@extends('templateinner6')

@section('content')
<div class="form_applicant">
      
<ul class="nav nav-pills contest_list">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#description">Данные о вакансии</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#characteristics">Участники</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#opinion">Программы</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#notification">Уведомления</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#results">Результаты</a>
  </li>
</ul>
<div class="tab-content">
  <div class="tab-pane fade show active" id="description">
    <div class="biofarm23">
    <ul>
        <li class="contest_list-info">
            <div class="date_time">Дата</div>
            <div class="date_time-text">{{ $post->created_at }}</div>
        </li>
        <li class="contest_list-info">
            <div class="org">Организация</div>
            <div class="org_info">{{ $post->departments->name }}</div>
        </li>
        <li class="contest_list-info">
            <div class="position">Должность</div>
            <div class="position_info"> {{ $post->positions->name }}</div>
        </li>
        <li class="contest_list-info">
            <div class="limit">Срок подачи заявки</div>
            <div class="limit_info">{{ $post->date_app }}</div>
        </li>
        <li class="contest_list-info">
            <div class="status">Статус</div>
            <div class="status_info">{{ $post->status }}</div>
        </li>
        <li class="contest_list-info">
            <div class="quantity">Количество участников</div>
            <div class="quantity_info">{{ count($post->appcontests) }}</div>
        </li>        
    </ul>
    </div>
  </div>
  <div class="tab-pane fade" id="characteristics">
  <div class='biofarm23'>
  <div class="form-gr" id="post_id">

    <input type="text" id="searchstaff" name="search" class="form-control"  placeholder="Поиск..." />

    </div>
<table id="customers_next" class="biofarm_next">
<thead>
  <tr>
    <th>ID</th>
    <th>ФИО</th>
    <th>Дата подачи</th>
    <th>Балл за предметное тестирование</th>
    <th>Балл за психологическое тестирование</th>
    <th>Средний балл за проектную программу</th>
    <th>Средний балл</th>
  </tr>
  </thead>
  <tbody>
      @foreach($post->appcontests as $item)
        <tr>
          <td>{{ $item->id ?? ""  }}</td>
          <td>{{ $item->surname ?? ""  }} {{ $item->name ?? ""  }} {{ $item->middle ?? ""  }}</td>
          <td>{{ $item->updated_at ?? ""  }}</td>
          <td>{{ $item->score ?? ""  }}</td>
          <td>{{ $item->scoretest ?? ""  }}</td>
          <td>{{ $item->scoreproject ?? ""  }}</td>
          <td>{{ $item->scoremiddle ?? ""  }}</td>
        </tr>
      @endforeach
</tbody>
</table>
</div>
  </div>
  <div class="tab-pane fade" id="opinion">
  <div class='biofarm23'>
    <div class="form-gr" id="post_id">

    <input type="text" id="searchstaff" name="search" class="form-control"  placeholder="Поиск..." />

    </div>
    <table id="customers_next" class="biofarm_next">
    <thead>
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Дата подачи</th>
        <th>Программа</th>
        <th>Коммиссия 1</th>
        <th>Коммиссия 2</th>
        <th>Коммиссия 3</th>
        <th>Коммиссия 4</th>
        <th>Коммиссия 5</th>
        <th>Средний балл</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $post2->id ?? ""  }}</td>
        <td>{{ $post2->applicants->surname ?? ""  }} {{ $post2->applicants->name ?? ""  }}</td>    
        <td>{{ $post2->file ?? ""  }}</td>
        <td>{{ $post2->date_programm ?? ""  }}</td>
        <td>{{ $post2->commission1 ?? ""  }}</td>
        <td>{{ $post2->commission2 ?? ""  }}</td>
        <td>{{ $post2->commission3 ?? ""  }}</td>
        <td>{{ $post2->commission4 ?? ""  }}</td>
        <td>{{ $post2->commission5 ?? ""  }}</td>
        <td>{{ $post2->commissionmiddle ?? ""  }}</td>
    </tr>
    
    </tbody>
    </table>
</div>
</div> 

<div class="tab-pane fade" id="notification">
  <div class='biofarm23'>
    <div class="form-gr" id="post_id">

    <input type="text" id="searchapp" name="search" class="form-control"  placeholder="Поиск..." />
    <button type="button" class="button_1 btn btn-info btn_contest"  data-toggle="modal" data-target="#modal1">Добавить</button>

    </div>
    <table id="customers_next" class="biofarm_next">
    <thead>
    <tr>
        <th>ID</th>
        <th>Тип уведомления</th>
        <th>Дата уведомления</th>
        <th>Текст уведомления</th>
        <th>Дата время</th>
        <th>Статус</th>
        <th>Действие</th>
    </tr>
    </thead>
    <tbody>
    @foreach($post3 as $item)
    <tr>        
        <td>{{ $item->id ?? ""  }}</td>
        <td>{{ $item->typenotifications->name ?? ""  }}</td>    
        <td>{{ $item->date_note ?? ""  }}</td>
        <td>{{ $item->text ?? ""  }}</td>
        <td>{{ $item->created_at ?? ""  }}</td>
        <td>{{ $item->status ?? ""  }}</td>
        <td>
        <div class="action_icons"> 
        <a href="{{ route('showcontest', ['id'=> $post->id]) }}"><input type="submit" title="Показать" class="draw-icon"></a>
        </div>
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>
</div>

</div> 
<div class="tab-pane fade" id="results">
  <div class='biofarm23'>
    <div class="form-gr" id="post_id">

    <input type="text" id="searchapp" name="search" class="form-control"  placeholder="Поиск..." />
   
    </div>
    <table id="customers_next" class="biofarm_next">
    <thead>
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Балл за предметное тестирование</th>
        <th>Балл за психологическое тестирование</th>
        <th>Средний балл за проектную программу</th>
        <th>Средний балл</th>
    </tr>
    </thead>
    <tbody>
    @foreach($post3 as $item)
    <tr>        
      <td>{{ $participant->id ?? ""  }}</td>
      <td>{{ $participant->applicantspar->surname ?? ""  }} {{ $participant->applicantspar->name ?? ""  }}</td>
      <td>{{ $participant->score ?? ""  }}</td>
      <td>{{ $participant->scoretest ?? ""  }}</td>
      <td>{{ $participant->scoreproject ?? ""  }}</td>
      <td>{{ $participant->scoremiddle ?? ""  }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
</div>

</div> 

</div>




<div class="modal hide fade modal_show" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
          <form id="form_app_note" class="form-horizontal" role="form" method="post" action="{{ route('notestore') }}"> 
          {{ csrf_field() }}
          <input type="hidden" id="contest_id" name="contest_id" value="{{ $post->id }}">
          <div class=""> 
          <label for="name" class="col-sm-3 control-label">
          Дата:</label> 
          <div class="alert_inner3"> 
          <input type="text" class="form-control" id="title" name="date" value="{{ $date2 }}"> 
          </div> 
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Тип уведомления:</label> 
          <div class=""> 
          <div class="alert_inner3">                            
                            <select id='oblast2' name="typenotification_id" class="choice form__input3 post__title3">
                            <option value="">Выберите адрес</option>
                            @foreach ($type as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}                                                                  
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text typenotification_id_error"></span>
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Текст уведомления:</label> 
          <div class=""> 
          <div class="alert_inner3">                            
                            <textarea id='oblast2' name="text" class="choice form__input3 post__title3">
                            </textarea>
                            <span class="text-danger error-text position_id_error"></span>
          </div> 
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Срок подачи заявки:</label> 
          <div class="alert_inner3"> 
          <input type="date" class="choice form-control" id="organization" name="date_note"> 
          <span class="text-danger error-text date_app_error"></span>
          </div> 
          </div> 

          <div class=""> 
          <div class=""> 
            <div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
</div>
          <button type="submit" id="submit" name="submit" class="">Отправить</button> 
          <div id="res"></div>
          </div> 
          </div> 
          <!--end Form--></form>         

          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
<div class="modal hide fade modal_show" id="pendingLeaveRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;" data-backdrop="false">
           <div class="modal-body" id="leave_details" >
             <p><span class="modal_alert"><p>Успешно отправлено</p><a class="btn btn-primary" href="/auth/contestlist">Главная</a></span></p>
           </div>
 </div>
</div>


 <script>
       $(document).ready(function(){
        $("#form_app_note").submit(function(e){
             e.preventDefault();
            let id=$('#contest_id').val();
            let url = $(this).attr('action');
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: url, 
                data: formData,
                cache:false,
                dataType:'json',
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $("#form_app_note").find('span.error-text').text('');
                    $('#loaderIcon').attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                   let success = '<span>'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary"   href="/auth/showcontest/'+id+'">'+'Назад'+'</a>'+ '</span>';
                    console.log(response.msg);
                    $('#leave_details').html(success); 
                    $('#pendingLeaveRequest').modal('show');
                }
            }
            });   
            
        });    
        
            
        })
</script>
@endsection