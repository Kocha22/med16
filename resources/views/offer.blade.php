@extends('templateinner3')

@section('content')
<div class="form_applicant">
 <form>
<section class="news">
        <div class="form-gr" id="post_id">

      <input type="text" id="searchstaff" name="search" class="form-control"  placeholder="Поиск..." />
      <div class="button-submit">                
        <input id="btn" class="button light-blue" type="submit" value="Поиск">                
                </div>

      </div>
       <table id="customers_next">
       <thead>
  <tr>
    <th>ФИО заявителя</th>
    <th>Дата рождения</th>
    <th>Адрес проживания</th>
    <th>Статус</th>
    <th>Просмотр</th>
    <th>Рейтинг</th>
    <th>Действие</th>
    <th>Согласовано</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->surname ?? "" }} {{ $post->name ?? "" }} {{ $post->middle ?? "" }}</td>
    <td>{{ $post->dateofbirth ?? "" }}</td>
    <td>{{ $post->residential_address ?? "" }}</td>
     <td>{{ $post->appstatuses->name ?? "" }}</td> 
    <td>
    <div class="action_icons"> 
     <a href="{{ route('showap', ['post_id'=> $post->id]) }}"><input type="submit" title="Показать" class="eye-icon"></a>
    </div>
    </td>
    <td>
    <div class="buttonsubmit2">                
    {{ $post->rating ?? "" }}
    </div>
    </td>
    <td>
    @if($loop->first && $post->agreed == '')
    <div class="button-submit"> 
    <button id="btn-{{ $post->id }}" data-num="{{ $post->id }}" type="button" data-toggle="modal" data-id='{{ $post->id }}'  data-target="#practice_modal"  class="btn_transaction btn_error btn btn-info">Отправить на почту заявителю</button>     
       </div>  
    @elseif($loop->first && $post->agreed == 'Да' || $post->agreed == 'Нет')
    <div class="button-submit"> 
    <button id="btn-{{ $post->id }}" data-num="{{ $post->id }}" type="button" data-toggle="modal" data-id='{{ $post->id }}'  data-target="#practice_modal"  class="btn_transaction btn_error btn btn-info" disabled>Отправлено на почту заявителю</button>     
       </div>
    @elseif($yes == 2)
    <div class="button-submit"> 
    <button id="btn-{{ $post->id }}" data-num="{{ $post->id }}" type="button" data-toggle="modal" data-id='{{ $post->id }}'  data-target="#practice_modal"  class="btn_transaction btn_error btn btn-info">Отправить на почту заявителю</button>     
       </div>
    @elseif($yes == 3)
    <div class="button-submit"> 
    <button id="btn-{{ $post->id }}" data-num="{{ $post->id }}" type="button" data-toggle="modal" data-id='{{ $post->id }}'  data-target="#practice_modal"  class="btn_transaction btn_error btn btn-info" disabled>Отправлено на почту заявителю</button>     
       </div>
    @else
    <div class="button-submit"> 
    <button id="btn-{{ $post->id }}" data-num="{{ $post->id }}" type="button" data-toggle="modal" data-id='{{ $post->id }}'  data-target="#practice_modal"  class="btn_transaction btn_error btn btn-info" disabled>Отправить на почту заявителю</button>     
       </div>
    @endif
    </td>
    <td>
        {{ $post->agreed ?? "" }}    
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
<div id="res"></div>
</form>
</div>
@if($yes == 1)
<div class="btn_inner">
<button type="button" class="button_1 btn btn-info btn_contest"  data-toggle="modal" data-target="#modal1">Обьявить конкурс</button>
</div>
@else
<div></div>
@endif
<div class="modal hide fade modal_show" id="practice_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
        <input type="hidden" id="color_id2" name="color_id" value="">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
        <form id="form_app5"> 
 {{ csrf_field() }}
 <input type="hidden" id="post_id" value="">
 <div class="form-group"> 
 <label for="name" class="">
 Тема:</label> 
 <div class=""> 
 <input name="title" rows="4" required class="form-control" id="title" placeholder="Тема"> 
 </div> 
 </div> 
 <div class="form-group"> 
 <label for="name" class="">
 Комментарий:</label> 
 <div class=""> 
 <textarea id="description" name="description" rows="4" required class="form-control" id="text" placeholder="Сообщение"></textarea> 
 </div> 
 </div> 
 <div class="form-group"> 
 <div class="">
<div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status" >
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
            <div id="loaderIcon2" class="spinner-border text-primary" style="display:none" role="status">
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
             <p><span class="modal_alert"><p>Успешно отправлено</p><a class="btn btn-primary" href="#">Главная</a></span></p>
           </div>
 </div>
<script>
$(document).ready(function(){
            $('body').on('click', '.btn_transaction', function (event) {
                event.preventDefault();
                var id = $(this).data('id');                                       
                $.get('/app/' + id + '/edit', function (data) {
                    $('#color_id2').val(data.data.id);                      
                })
            });

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
                    $('#loaderIcon2').attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    console.log(response.msg);
                    $('#loaderIcon2').attr('style', 'display:none');
                    $('#form_app').modal('hide');
                    window.location.href='/auth/contestlist';
                }
            }
            });   
            
        });    

            $("#form_app5").submit(function(e){
             e.preventDefault();
            var formData = new FormData(this);
            let post_id = $('#color_id2').val();
            var id = $(this).data('id');
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '/appup/'+post_id, 
                data: formData,
                cache:false,
                dataType:'json',
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $("#loaderIcon").attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    let post_ido =response.post_id;
                    console.log(response.msg);
                    console.log(id);   
                    $('#form_app5').trigger("reset");
                    $('#practice_modal').modal('hide');
                    $("#loaderIcon").attr('style', 'display:none');
                    $("#btn-"+post_id).html('Отправлено на почту заявителю');
                    $("#btn-"+post_id).prop('disabled', true);
                }
            }
            });   
            
        });

});
</script>
 @endsection