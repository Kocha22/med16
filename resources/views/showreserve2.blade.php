@extends('templateinner3')

@section('content')
<div class="form_applicant">
<div class="personal_inner">
    <p class="personal_title">Личные данные</p>
</div>
  <form id="frm" action="" method="post">
    <input type="hidden" id="token" value="{{ @csrf_token() }}">
      <section class="news">
       <div class="container">
                <form id="frm" action="" method="post">
                    
                    <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="name">ФИО заявителя</label></td>
                            <td><div id="name">{{ $post->surname ?? "" }} {{ $post->name ?? ""  }} {{ $post->middle ?? ""  }}</div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="dateofbirth">Дата рождения</label></td>
                            <td>{{ $post->dateofbirth ?? ""  }}
                             </td>
                        </tr>
                         <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->residential_address ?? ""  }}
                             </td>
                        </tr>  
                        <tr>
                            <td><label for="email">Адрес электронной почты</label></td>
                            <td>{{ $post->email ?? ""  }}
                             </td>
                        </tr>
                        <tr>
                            <td><label for="email">Название организации здравоохранения</label></td>
                            <td>{{ $post->order ?? ""  }}
                             </td>
                        </tr>                                                                
                    </tbody>
                </table>
                <div id="res" ></div>
               
                </form>

       <div>
</section>
<div class="personal_inner">
    <p class="personal_title">Образования</p>
</div>
<table id="customers_next">
       <thead>
  <tr>
    <th>ID</th>
    <th>Наименование организации</th>
    <th>Год поступления/окончания, дату прох-я</th>
    <th>Специальность/квалификация</th>
    @if(!empty($item->nameofseminar))
    <th>Наименования курса,семинара</th>
    @endif
  </tr>
  </thead>
  <tbody>
  @foreach($graduations as $item)
  <tr>
    <td>{{ $item->id }}</td>
    <td>
        @if(!empty($item->nameofuniversity))
            {{ $item->nameofuniversity ?? ""  }}
        @endif
    </td>
    <td>
        @if(!empty($item->dateofentry))
        {{ $item->dateofentry ?? ""  }}
        @endif
        @if(!empty($item->graduation))
        {{ $item->graduation ?? ""  }}
        @endif
    </td>
    <td>
        @if(!empty($item->nameofseminar))
            {{ $item->nameofseminar }}
        @endif
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
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
  @foreach($data as $item)
  <tr>
    <td>
        @if(!empty($item->organizations->name))
            {{ $item->organizations->name }}
        @endif
    </td>
    <td>
        @if(!empty($item->positions->name))
            {{ $item->positions->name }}
        @endif
    </td>
    <td>
        @if(!empty($item->jobdate))
            {{ $item->jobdate }}
        @endif
    </td>
    <td>
        @if(!empty($item->termination))
            {{ $item->termination }}
        @endif
    </td>
    <td>
        @if(!empty($item->warrant))
            {{ $item->warrant }}
        @endif
    </td>
    <td>
        @if(!empty($item->begindate))
            {{ $item->begindate }}
        @endif
    </td>
    <td>
        @if(!empty($item->enddate))
            {{ $item->enddate }}
        @endif
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
<div class="personal_inner">
     <p class="personal_title">Аттестация</p>
</div>
<section class="news">
       <div class="container">
                <form id="frm" action="" method="post">
 
                    <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="name">Дата прохождения</label></td>
                            <td><div id="name">                                
                                @if(!empty($valid->dateofentry))
                                    {{ $valid->dateofentry }}
                                @endif                          
                            </div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="nameofdirector">Присвоенная квалификация</label></td>
                            <td>
                            @if(!empty($valid->qualifications->name))
                                    {{ $valid->qualifications->name }}
                            @endif  
                             </td>                              
                        </tr>
                                                                             
                    </tbody>
                </table>
               
                </form>

       <div>
</section>
<div class="personal_inner">
    <p class="personal_title">Документы</p>
</div>
<table id="customers_next">
       <thead>
  <tr>
    <th>Вид документа</th>
    <th>Наименование документа</th>
    <th>Прикрепленный файл</th>
    <th>Описание</th>    
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
  @foreach($additions as $item)
  <tr>
    <td></td>
    <td>
        @if(!empty($item->id))
            {{ $item->id}}
        @endif  
    </td>
    <td>
        @if(!empty($item->qualifications->name))
            {{ $item->qualifications->name}}
        @endif 
    </td>
    <td>
        @if(!empty($item->other_award))
            {{ $item->other_award}}
        @endif 
    </td>   
    <td>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
<div class="personal_inner">
    <p class="personal_title">Дополнительная информация</p>
</div>
<div id="res" ></div>
</form>
 <div class="btn_inner">
<button type="button" class="button_1 btn btn-info"  data-toggle="modal" data-target="#modal1">На рассмотрений</button>

<button type="button" class="button_1 btn btn-success" data-toggle="modal" data-target="#modal2">Одобрить</button>

<button type="button" class="button_1 btn btn-danger" data-toggle="modal" data-target="#modal3">Отказать</button>
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
          <form id="form_app" class="form-horizontal" role="form" method="post" action="{{ route('sendcon', ['post_id'=> $post->id]) }} "> 
          {{ csrf_field() }}
          <div class=""> 
          <label for="name" class="">
          Тема:</label> 
          <div class=""> 
          <input type="text" class="form-control" id="title" name="title" placeholder="Тема сообщений" required> 
          </div> 
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Сообщение:</label> 
          <div class=""> 
          <textarea name="text" rows="4" required class="form-control" id="text" placeholder="Сообщение"></textarea> 
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



<div class="modal hide fade modal_show" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
        <form id="form_app2" class="" role="form" method="post" action="{{ route('approve', ['post_id'=> $post->id]) }}"> 
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


<div class="modal hide fade modal_show" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
        <form id="form_app3" class="" role="form" method="post" action="{{ route('cancel', ['post_id'=> $post->id]) }} "> 
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
             <p><span class="modal_alert"><p>Успешно отправлено</p><a class="btn btn-primary" href="#">Главная</a></span></p>
           </div>
 </div>
</div>
<div class="button-submit">                
<a class="button red" href="{{ route('applicationinner') }}">Назад</a>
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
                    $("#form_app2").find('span.error-text').text('');
                    $('#loaderIcon').attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                   let success = '<span>'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary"   href="/auth/showap/'+response.post_id+'">'+'Назад'+'</a>'+ '</span>';
                    console.log(response.msg);
                    $('#leave_details').html(success); 
                    $('#pendingLeaveRequest').modal('show');
                }
            }
            });   
            
        });

        $("#form_app2").submit(function(e){
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
                    $('#loaderIcon').attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                   let success = '<span>'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary"   href="/auth/showap/'+response.post_id+'">'+'Назад'+'</a>'+ '</span>';
                    console.log(response.msg);
                    $('#leave_details').html(success); 
                    $('#pendingLeaveRequest').modal('show');
                }
            }
            });   
            
        });
        
        $("#form_app3").submit(function(e){
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
                    $("#form_app3").find('span.error-text').text('');
                    $('#loaderIcon').attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                  let success = '<span>'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary"   href="/auth/showap/'+response.post_id+'">'+'Назад'+'</a>'+ '</span>';
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