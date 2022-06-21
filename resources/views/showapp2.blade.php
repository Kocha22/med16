@extends('templateinner3')

@section('content')
<div class="form_applicant">
<div class="personal_inner">
    <p class="personal_title">Личные данные</p>
</div>
 <form id="frm" action="" method="post">
    <input type="hidden" id="token" value="{{ @csrf_token() }}">
    <input type="hidden" id="post_id" value="{{ $post->id ?? "" }}">
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
 <div class="btn_inner">
  @if($post->appuserstatus_id == 1)
<button type="button" id="button_app2" class="button_show btn btn-info"  data-url="{{  route('sendaction', ['user_id'=>$post->user_id])   }}">Отправить на обучение/переподготовку</button>
@else
<button type="button" id="button_app2" class="button_show btn btn-info"  data-url="{{  route('sendaction', ['user_id'=>$post->user_id])   }}" disabled>Отправлено на обучение/переподготовку</button>
@endif
</div>
</div>

<div class="button-submit">                
<a class="button red" href="{{ route('applicationinner') }}">Назад</a>
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
                if(response.post_o == 14) {
                  $('#button_app2').prop('disabled', true);
                  $('#button_app2').html('Отправлено на обучение/переподготовку');
                } else if (response.post_o == 13) {
                  $('#button_app').prop('disabled', true);
                  $('#button_app2').attr('style', 'display:inline;');
                } 
                
              }
              });
              } 
           
           
         $(".button_show").click(function(e) {
            e.preventDefault();
            let post_id=$('#post_id').val();
            let url = $(this).attr('data-url');
            $('#button_app').prop('disabled', true);
            $('#button_app').text('Заявка подано');
             $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                success: function(response){                    
                    console.log(response.msg);
                    fetch_customer_data()
                    }

            });
        });    
        

        })
</script>
@endsection