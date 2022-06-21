@extends('templateinner6')

@section('content')
<div class="form_applicant">
<section class="news">
   <div class="form-gr">
      <input type="text" id="searchapp" name="search" class="form-control"  placeholder="Поиск..." />
      <button type="button" class="button_1 btn btn-info btn_contest"  data-toggle="modal" data-target="#modal1">Добавить</button>
      </div>
       <table id="customers_next">
       <thead>
  <tr>
    <th>Организация</th>
    <th>Должность</th>
    <th>Срок подачи заявки</th>
    <th>Статус</th>
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->departments->name ?? "" }}</td>
    <td>{{ $post->positions->name ?? "" }}</td>
    <td>{{ $post->date_app ?? "" }}</td>
    <td>{{ $post->status ?? ""}}</td>
    <td>
    <div class="action_icons"> 
    <a href="{{ route('showcontest', ['id'=> $post->id]) }}"><input type="submit" title="Показать" class="eye-icon"></a>
    </div>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
</div>



<div class="modal hide fade modal_show" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
          <form id="form_app" class="form-horizontal" role="form" method="post" action="{{ route('conteststore') }}"> 
          {{ csrf_field() }}
          <div class=""> 
          <label for="name" class="col-sm-3 control-label">
          Дата:</label> 
          <div class="alert_inner3"> 
          <input type="text" class="form-control" id="title" name="date" value="{{ $date2 }}"> 
          </div> 
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Организация:</label> 
          <div class=""> 
          <div class="alert_inner3">                            
                            <select id='oblast2' name="department_id" class="choice form__input3 post__title3">
                            <option value="">Выберите адрес</option>
                            @foreach ($department as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}                                                                  
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text organization_id_error"></span>
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Должность:</label> 
          <div class=""> 
          <div class="alert_inner3">                            
                            <select id='oblast2' name="position_id" class="choice form__input3 post__title3">
                            <option value="">Выберите адрес</option>
                            @foreach ($position as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }} 
                                                                  
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text position_id_error"></span>
          </div> 
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Срок подачи заявки:</label> 
          <div class="alert_inner3"> 
          <input type="date" class="choice form-control" id="organization" name="date_app"> 
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
        $("#form_app").submit(function(e){
             e.preventDefault();
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
                    $("#form_app").find('span.error-text').text('');
                    $('#loaderIcon').attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    $('#loaderIcon').attr('style', 'display:none');
                    $('#modal1').modal('hide');
                    location.reload();
                }
            }
            });   
            
        });    
        
            
        })
</script>
 @endsection