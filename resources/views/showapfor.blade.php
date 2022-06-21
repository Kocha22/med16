@extends('templateinner')

@section('content')
<div class="form_applicant">
<div class="personal_inner-maintitle">Заявление на включение в резерв кадров руководителей организации</div>
<div class="personal_inner">     
    <p class="personal_title">Личные данные</p>
</div>
 <form id="frm" action="" method="post">
    <input type="hidden" id="token" value="{{ @csrf_token() }}">
    <input type="hidden" id="user_id" value="{{ $user_id ?? '' }}">
    <input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
    <input type="hidden" id="user_status" value="{{ $post->appuserstatus_id ?? '' }}">
      <section class="news">
       <div class="container">
                <form id="frm" action="" method="post">
                    
                    <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="name">Номер заявки</label></td>
                            <td><div id="name">{{ $post->applicant_code ?? '' }}</div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="name">ФИО заявителя</label></td>
                            <td><div id="name">{{ $post->name ?? '' }}</div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="dateofbirth">Дата рождения</label></td>
                            <td>{{ $post->dateofbirth ?? '' }}
                             </td>
                        </tr>
                         <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->address ?? '' }}
                             </td>
                        </tr>  
                        <tr>
                            <td><label for="email">Адрес электронной почты</label></td>
                            <td>{{ $post->email ?? '' }}
                             </td>
                        </tr>
                        <tr>
                            <td><label for="email">Статус</label></td>
                            <td>{{ $post->appuserstatus->name ?? '' }}</td>
                        </tr>
                                                         
                    </tbody>
                </table>
                @if($post->appuserstatus_id == 5 || $post->appuserstatus_id == 9)
                <div class="redit">
                  <a href="{{ route('createapplicant', ['user_id'=>$user_id]) }}"  class="link_edit" >Редактировать</a>
                </div>
                @else
                <div class="redit">
                  <a href="{{ route('createapplicant', ['user_id'=>$user_id]) }}"  class="link_edit" style="pointer-events: none;">Редактировать</a>
                </div>
                @endif
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
    <td>{{ $item->nameoforganization ?? '' }}</td>    
    <td>{{ $item->dateofentry ?? '' }}</td>
    <td>{{ $item->specialities->name ?? '' }}</td>
    <td>{{ $item->name ?? '' }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
@if($post->appuserstatus_id == 5 || $post->appuserstatus_id == 9)
<div class="redit">
    <a href="{{ route('createeducation', ['user_id'=>$user_id]) }}"  class="link_edit">Редактировать</a>
</div>
@else
<div class="redit">
    <a href="{{ route('createeducation', ['user_id'=>$user_id]) }}"  class="link_edit" style="pointer-events: none;">Редактировать</a>
</div>
@endif
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
    <td>{{ $item->organizations->name ?? '' }}</td>
    <td>{{ $item->positions->name ?? "" }}</td>    
    <td>{{ $item->jobdate ?? '' }}</td>
    <td>{{ $item->termination ?? '' }}</td>
    <td>{{ $item->warrant ?? '' }}</td>
    <td>{{ $item->begindate ?? '' }}</td>
    <td>{{ $item->enddate ?? '' }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
@if($post->appuserstatus_id == 5 || $post->appuserstatus_id == 9)
<div class="redit">
    <a href="{{ route('createexperience', ['user_id'=>$user_id]) }}"  class="link_edit">Редактировать</a>
</div>
@else
<div class="redit">
    <a href="{{ route('createexperience', ['user_id'=>$user_id]) }}" style="pointer-events:none;"  class="link_edit">Редактировать</a>
</div>
@endif
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
    <td>{{ $item->typeofdocuments->name ?? '' }}</td>
    <td>{{ $item->nameofdocument ?? '' }}</td>    
    <td>{{ $item->file ?? '' }}</td>
    <td>
        <div class="img_wr">
           <div class="image__wrapper" style="display:none;">
               @if($item->file)
              <img src="{{ $item->file ? route('download', ['file'=>$item->file]) : ''}} " class="minimized" alt="клик для увеличения" />
              @endif
            </div>
            <a href="javascript: return false;" class="link">Просмотр</a>
       </div>
        <a href="{{ $item->file ? route('download', ['file'=>$item->file]) : ''}}">Скачать</a>
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
    <td>{{ $item->text ?? ''  }}</td>
    <td>{{ $item->typeofdocuments->name ?? '' }}</td>    
    <td>{{ $item->file ?? '' }}</td>
    <td>{{ $item->dateofdocument ?? '' }}</td>
    <td>{{ $item->desciption ?? '' }}</td>
     <td>
           <div class="img_wr">
               <div class="image__wrapper" style="display:none;">
                   @if($item->file)
                  <img src="{{ $item->file ? route('download', ['file'=>$item->file]) : ''}}" class="minimized" alt="клик для увеличения" />
                  @endif
                </div>
                <a href="javascript: return false;" class="link">Просмотр</a>
           </div>
         <a href="{{ $item->file ? route('download', ['file'=>$item->file]) : ''}}">Скачать</a>
         </td>
  </tr>
  @endforeach
  </tbody>
</table>
@if($post->appuserstatus_id == 5 || $post->appuserstatus_id == 9)
<div class="redit">
    <a href="{{ route('createextra', ['user_id'=>$user_id]) }}" class="link_edit">Редактировать</a>
</div>
@else
<div class="redit">
    <a href="{{ route('createextra', ['user_id'=>$user_id]) }}" class="link_edit" style="pointer-events:none;">Редактировать</a>
</div>
@endif
</section>
</form>
    <div>
        @if($post->appuserstatus_id == 5 || $post->appuserstatus_id == 8  || $post->appuserstatus_id == 11  || $post->appuserstatus_id == 14 || $post->appuserstatus_id == 15 || $post->appuserstatus_id == 16 || $post->appuserstatus_id == 1 || $post->appuserstatus_id == 3 || $post->appuserstatus_id == 2)
        <div style="padding-left:15px;margin:25px 0;">
        <input id="checkbox" type="checkbox" name="agreement" value="1" checked disabled> согласен на обработку персональных данных
        </div>
        @elseif($post->appuserstatus_id == 9)
        <div style="padding-left:15px;margin:25px 0;">
        <input id="checkbox" type="checkbox" name="agreement" value="1"> согласен на обработку персональных данных
        </div>
        @else
        <div style="padding-left:15px;margin:25px 0;">
        <input id="checkbox" type="checkbox" name="agreement" value="1"> согласен на обработку персональных данных
        </div>
        @endif
    </div>  
 <div class="btn_inner">
@if($post->appuserstatus_id == 5 || $post->appuserstatus_id == 8 || $post->appuserstatus_id == 1 || $post->appuserstatus_id == 3 || $post->appuserstatus_id == 2 || $post->appuserstatus_id == 14 || $post->appuserstatus_id == 15 || $post->appuserstatus_id == 16)
<button type="button" id="button_app" class="button_show btn btn-info"  data-url="{{  $user_id ?  route('successaction', ['user_id'=>$user_id])  : '' }}" disabled>Заявка подана</button>
@elseif($post->appuserstatus_id == 11)
<button type="button" id="button_app" class="button_show btn btn-info"  data-url="{{  $user_id ?  route('successaction', ['user_id'=>$user_id])  : '' }}" disabled>Заявка отказана</button>
@elseif($post->appuserstatus_id == 9 || $post->appuserstatus_id == 6)
<button type="button" id="button_app" class="button_show btn btn-info"  data-url="{{  $user_id ?  route('successaction', ['user_id'=>$user_id])  : '' }}" disabled>Подать заявку</button>
@else
<button type="button" id="button_app" class="button_show btn btn-info"  data-url="{{  $user_id ?  route('successaction', ['user_id'=>$user_id])  : '' }}">Подать заявку</button>
<button type="button" id="button_app4" class="button_show3 btn btn-info"  data-url="{{  $post->id ?? '' ?  route('tuccessaction', ['post_id'=>$post->id])  : '' }}" style="display:none;">Редактировать данные</button>
@endif
<div id="loaderIcon3" class="spinner-border text-primary" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
</div>
</div>
</div>
    <script>
       $(document).ready(function(){
        let user_status = $('#user_status').val();


        $('#checkbox').change(function(){
        if($('#checkbox').is(':checked')){
                console.log("asdad");
                $('#button_app').prop('disabled', false);
            } else{
                $('#button_app').prop('disabled', true);
            }
        })
        
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
            if(response.post_o == 5 || response.post_o == 8) {
              $('#button_app').prop('disabled', true);
              $('.link_edit').attr('style', 'pointer-events: none');
              $('#button_app').text('Заявка подана');
            } else if (response.post_o == 11) {
              $('#button_app').prop('disabled', true);
              $('.link_edit').attr('style', 'pointer-events: none');
              $('#button_app').text('Заявка отказана');
            } else if (response.post_o == 13) {
              $('#button_app').prop('disabled', true);
              $('#button_app4').attr('style', 'display:inline');
            } else {
              $('#button_app').prop('disabled', true);
              $('.link_edit').attr('style', 'pointer-events: auto');
              $('#button_app4').attr('style', 'display:none');
            }
            
          }
          });
          } 


       $(".button_show").click(function(e) {
            e.preventDefault();
            let user_id=$('#user_id').val();
            let url = $(this).attr('data-url');
            $('#button_app').prop('disabled', true);
            $('#button_app').text('Заявка подана');
            $('#checkbox').prop('disabled', true);
             $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                beforeSend:function(){
                    $('#loaderIcon3').attr('style', 'display:block');
                },
                success: function(response){
                    console.log(response.msg);
                    $('#loaderIcon3').attr('style', 'display:none');
                    let post_id2 = response.post_id;
                    let post_id = $('#post_id').val(post_id2);
                    fetch_customer_data();
                    }

            });
        });

        $(".button_show3").click(function(e) {
            e.preventDefault();
            let user_id=$('#user_id').val();
            let url = $(this).attr('data-url');
            $('#button_app').prop('disabled', true);
            $('#button_app').text('Подать заявку');
             $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                beforeSend:function(){
                    $('#loaderIcon3').attr('style', 'display:block');
                },
                success: function(response){
                    console.log(response.msg);
                    $('#loaderIcon3').attr('style', 'display:none');
                    let post_id2 = response.post_id;
                    let post_id = $('#post_id').val(post_id2);
                    fetch_customer_data();
                    }

            });
        });

        
            
        })
</script>
@endsection