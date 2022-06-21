@extends('templateinner3')

@section('content')
<div class="form_applicant">
<div class="personal_inner">
    <p class="personal_title">Личные данные</p>
</div>
 <form id="frm" action="" method="post">
    <input type="hidden" id="token" value="{{ @csrf_token() }}">
    <input type="hidden" id="post_id" value="{{ $post->id }}">
      <section class="news">
       <div class="container">
                <form id="frm" action="" method="post">
                    
                    <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="name">Номер заявки</label></td>
                            <td><div id="name">{{ $post->applicant_code ?? "" }}</div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="name">ФИО заявителя</label></td>
                            <td><div id="name">{{ $post->name ?? "" }}</div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="dateofbirth">Дата рождения</label></td>
                            <td>{{ $post->dateofbirth ?? "" }}
                             </td>
                        </tr>
                         <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->address ?? "" }}
                             </td>
                        </tr>  
                        <tr>
                            <td><label for="email">Адрес электронной почты</label></td>
                            <td>{{ $post->email ?? "" }}
                             </td>
                        </tr>
                        <tr>
                            <td><label for="email">Статус</label></td>
                            <td>{{ $post->appuserstatus->name ?? '' }}</td>
                        </tr>
                                                         
                    </tbody>
                </table>
                <div id="res" ></div>
               
                </form>

       <div>
</section>
<section class="news">
<div class="personal_inner">
    <p class="personal_title">Образования</p>
</div>
       <table id="customers_next">
       <thead>
  <tr>
    <th>Тип образования</th>
    <th>Наименование организации</th>
    <th>Год поступления/окончания, дату прох-я</th>
    <th>Специальность/квалификация</th>
    <th>Наименования курса,семинара</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data as $item)
  <tr>
    <td>{{ $item->typeofeducation->name ?? "" }}</td>
    <td>{{ $item->nameoforganization ?? "" }}</td>    
    <td>{{ $item->dateofentry ?? "" }}</td>
    <td>{{ $item->specialities->name ?? "" }}</td>
    <td>{{ $item->name ?? "" }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
<section class="news">
<div class="personal_inner">
    <p class="personal_title">Опыт работы</p>
</div>
       <table id="customers_next">
       <thead>
  <tr>
    <th>Наименование организации</th>
    <th>Должность</th>
    <th>Дата устройства</th>
    <th>Дата увольнения</th>
    <th>Номер приказа</th>
    <th>Дата заключ-я</th>
    <th>Дата оконч-я</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data2 as $item)
  <tr>
    <td>{{ $item->organizations->name ?? "" }}</td>
    <td>{{ $item->positions->name ?? "" }}</td>    
    <td>{{ $item->jobdate ?? "" }}</td>
    <td>{{ $item->termination ?? "" }}</td>
    <td>{{ $item->warrant ?? "" }}</td>
    <td>{{ $item->begindate ?? "" }}</td>
    <td>{{ $item->enddate ?? "" }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
<div class="personal_inner">
    <p class="personal_title">Аттестация</p>
</div>
<section class="news">
       <div class="container">
                      <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="name">Дата прохождения</label></td>
                            <td><div id="name">                                
                                @if(!empty($valid->dateofentry))
                                    {{ $valid->dateofentry ?? "" }}
                                @endif                          
                            </div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="nameofdirector">Присвоенная квалификация</label></td>
                            <td>
                            @if(!empty($valid->qualifications->name))
                                    {{ $valid->qualifications->name ?? "" }}
                            @endif  
                             </td>                              
                        </tr>
                                                                             
                    </tbody>
                </table>
       <div>
</section>
<section class="news">
<div class="personal_inner">
    <p class="personal_title">Документы</p>
</div>
       <table id="customers_next">
       <thead>
  <tr>
    <th>Вид документа</th>
    <th>Наименование документа</th>
    <th>Прикрепленный файл</th>
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data3 as $item)
  <tr>
    <td>{{ $item->typeofdocuments->name ?? "" }}</td>
    <td>{{ $item->nameofdocument ?? "" }}</td>    
    <td>{{ $item->file ?? "" }}</td>
    <td>
        <div class="img_wr">
           <div class="image__wrapper" style="display:none;">
              <img src="{{ route('download', ['file'=>$item->file ?? '' ]) }}" class="minimized" alt="клик для увеличения" />
            </div>
            <a href="javascript: return false;" class="link">Просмотр</a>
       </div>
        <a href="{{ route('download', ['file'=>$item->file ?? '' ]) }}">Скачать</a>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
<section class="news">
<div class="personal_inner">
    <p class="personal_title">Дополнительная информация</p>
</div>
       <table id="customers_next">
       <thead>
  <tr>
    <th>Дополнительная информация</th>
    <th>Вид документа</th>
    <th>Прикрепленный файл</th>
    <th>Дата документа</th>
    <th>Описание</th>
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data4 as $item)
  <tr>
    <td>{{ $item->text ?? "" }}</td>
    <td>{{ $item->typeofdocuments->name ?? "" }}</td>    
    <td>{{ $item->file ?? "" }}</td>
    <td>{{ $item->dateofdocument ?? "" }}</td>
    <td>{{ $item->desciption ?? "" }}</td>
     <td>
           <div class="img_wr">
               <div class="image__wrapper" style="display:none;">
                  <img src="{{ route('download', ['file'=>$item->file ?? '' ]) }}" class="minimized" alt="клик для увеличения" />
                </div>
                <a href="javascript: return false;" class="link">Просмотр</a>
           </div>
         <a href="{{ route('download', ['file'=>$item->file ?? '' ]) }}">Скачать</a>
         </td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
</form>
@if($post->appuserstatus_id == 5 || $post->appuserstatus_id == 8)
 <div class="btn_inner">
<button type="button" id="btn1" class="button_1 btn btn-info"  data-toggle="modal" data-target="#modal4">Возврат на редактировании</button>

<button type="button" id="btn2" class="button_1 btn btn-success" data-toggle="modal" data-target="#modal2">Одобрить</button>

<button type="button" id="btn3" class="button_1 btn btn-danger" data-toggle="modal" data-target="#modal3">Отказать</button>
</div>
@elseif($post->appuserstatus_id == 1)
<div class="btn_inner">
<button type="button" id="btn1" class="button_1 btn btn-info"  data-toggle="modal" data-target="#modal4" disabled>Возврат на редактировании</button>

<button type="button" id="btn2" class="button_1 btn btn-success" data-toggle="modal" data-target="#modal2" disabled>Одобрена</button>

<button type="button" id="btn3" class="button_1 btn btn-danger" data-toggle="modal" data-target="#modal3" disabled>Отказать</button>
</div>
@elseif($post->appuserstatus_id == 13)
<div class="btn_inner">
<button type="button" id="btn1" class="button_1 btn btn-info"  data-toggle="modal" data-target="#modal4" disabled>Возвращен на редактировании</button>

<button type="button" id="btn2" class="button_1 btn btn-success" data-toggle="modal" data-target="#modal2" disabled>Одобрить</button>

<button type="button" id="btn3" class="button_1 btn btn-danger" data-toggle="modal" data-target="#modal3" disabled>Отказать</button>
</div>
@elseif($post->appuserstatus_id == 11)
<div class="btn_inner">
<button type="button" id="btn1" class="button_1 btn btn-info"  data-toggle="modal" data-target="#modal4" disabled>Возвращен на редактировании</button>

<button type="button" id="btn2" class="button_1 btn btn-success" data-toggle="modal" data-target="#modal2" disabled>Одобрить</button>

<button type="button" id="btn3" class="button_1 btn btn-danger" data-toggle="modal" data-target="#modal3" disabled>Отказано</button>
</div>
@else
<div></div>
@endif
</div>

<div class="modal hide fade modal_show" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
        <form id="form_app2" class="" role="form" method="post" action="{{ route('approve2', ['post_id'=> $post->id]) }}"> 
 {{ csrf_field() }}
 <div class="form-group"> 
 <label for="name" class="">
 Номер приказа:</label> 
 <div class=""> 
 <input type="text" class="form-control" id="name" name="title" placeholder="Введите номер приказа" required> 
 </div> 
 </div> 
 <div class="form-group"> 
 <label for="message" class="">
 Файл:</label> 
 <div class=""> 
 <input type="file" name="file" rows="4" required class="form-control" id="message" title="Приложите файл">
 </div> 
 </div> 
 <div class="form-group"> 
 <div class=""> 
   <div id="loaderIconApprove" class="spinner-border text-primary" style="display:none" role="status">
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


<div class="modal hide fade modal_show" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
        <form id="form_app3" class="" role="form" method="post" action="{{ route('cancel2', ['post_id'=> $post->id]) }} "> 
 {{ csrf_field() }}
 <div class="form-group"> 
 <label for="name" class="">
 Номер приказа:</label> 
 <div class=""> 
 <input type="text" class="form-control" id="title" name="title" placeholder="Введите номер приказа" required> 
 </div> 
 </div> 
 <div class="form-group"> 
 <label for="message" class="">
 Файл:</label> 
 <div class=""> 
 <input type="file" name="file" rows="4" required class="form-control" id="message" title="Приложите файл">
 </div> 
 </div> 
 <div class="form-group"> 
 <div class="">
<div id="loaderIconCancel" class="spinner-border text-primary" style="display:none" role="status" >
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

<div class="modal hide fade modal_show" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
        <form id="form_app5" class="" role="form" method="post" action="{{ route('edit', ['post_id'=> $post->id]) }} "> 
 {{ csrf_field() }}
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
 <textarea name="description" rows="4" required class="form-control" id="text" placeholder="Сообщение"></textarea> 
 </div> 
 </div> 
 <div class="form-group"> 
 <div class="">
<div id="loaderIconEdit" class="spinner-border text-primary" style="display:none" role="status" >
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
</div>
<div class="button-submit">                
<a class="button red" href="{{ route('main') }}">Назад</a>
</div>
    <script>
       $(document).ready(function(){
        let post_id = $('#post_id').val();
            fetch_customer_data()
            function fetch_customer_data()
            {
              $.ajax({
              url:"/ruccessaction/"+post_id,
              method:'GET',
              dataType:'json',
              success:function(response)
              {
                if(response.post_o == 13) {
                  $('.button_1').prop('disabled', true);
                  $('#btn1').text('Возвращено на редактирование');
                } else if(response.post_o == 1) {
                    $('.button_1').prop('disabled', true);
                    $('#btn2').text('Одобрено');
                } else if(response.post_o == 11) {
                    $('.button_1').prop('disabled', true);
                    $('#btn3').text('Отказано');
                }
              }
              });
              } 
           


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
                    $("#form_app2").find('span.error-text').text('');
                    $("#loaderIcon").attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                   let success = '<span>'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary"   href="/auth/showapp/'+response.post_id+'">'+'Назад'+'</a>'+ '</span>';
                    console.log(response.msg);
                    $('#leave_details').html(success); 
                    $('#pendingLeaveRequest').modal('show');
                }
            }
            });   
            
        });

        $("#form_app5").submit(function(e){
             e.preventDefault();
            let url = $(this).attr('action');
            var formData = new FormData(this);
            $('.button_1').prop('disabled', true);
            $('#btn1').text('Возвращено на редактирование');
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
                    $("#form_app5").find('span.error-text').text('');
                    $("#loaderIconEdit").attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    $("#loaderIconEdit").attr('style', 'display:block');
                    $("#modal4").modal('hide');
                }
            }
            });   
            
        });

        $("#form_app2").submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            var formData = new FormData(this);
            $('.button_1').prop('disabled', true);
            $('#btn2').text('Одобрено');
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
                    $("#form_app2").find('span.error-text').text('');
                     $("#loaderIconApprove").attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    $("#loaderIconApprove").attr('style', 'display:block');
                    $("#modal2").modal('hide');
                }
            }
            });   
            
        });
        
        $("#form_app3").submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            var formData = new FormData(this);
            $('.button_1').prop('disabled', true);
            $('#btn3').text('Отказано');
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
                    $("#form_app3").find('span.error-text').text('');
                     $("#loaderIconCancel").attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    $("#loaderIconCancel").attr('style', 'display:block');
                    $("#modal3").modal('hide');
                }
            }
            });   
            
        });

        
            
        })
</script>
@endsection