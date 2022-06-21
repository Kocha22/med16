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
                        <tr>
                            <td><label for="email">Статус</label></td>
                            <td>{{ $post->appuserstatus->name ?? "" }}</td>
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
    <td>{{ $item->id ?? "" }}</td>
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
            {{ $item->nameofseminar ?? "" }}
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
            {{ $item->organizations->name ?? "" }}
        @endif
    </td>
    <td>
        @if(!empty($item->positions->name))
            {{ $item->positions->name ?? "" }}
        @endif
    </td>
    <td>
        @if(!empty($item->jobdate))
            {{ $item->jobdate ?? "" }}
        @endif
    </td>
    <td>
        @if(!empty($item->termination))
            {{ $item->termination ?? "" }}
        @endif
    </td>
    <td>
        @if(!empty($item->warrant))
            {{ $item->warrant ?? "" }}
        @endif
    </td>
    <td>
        @if(!empty($item->begindate))
            {{ $item->begindate ?? "" }}
        @endif
    </td>
    <td>
        @if(!empty($item->enddate))
            {{ $item->enddate ?? "" }}
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
            {{ $item->id ?? "" }}
        @endif  
    </td>
    <td>
        @if(!empty($item->qualifications->name))
            {{ $item->qualifications->nam ?? "" }}
        @endif 
    </td>
    <td>
        @if(!empty($item->other_award))
            {{ $item->other_award ?? "" }}
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
@if($post->appuserstatus_id == 1)
<button type="button" id="button_app2" class="button_show btn btn-info"  data-url="{{  route('sendaction', ['user_id'=>$post->id])   }}">Отправить на обучение/переподготовку</button>
@else
<button type="button" id="button_app2" class="button_show btn btn-info"  data-url="{{  route('sendaction', ['user_id'=>$post->id])   }}" disabled>Отправлено на обучение/переподготовку</button>
@endif
</div>
</div>

<div class="button-submit">                
<a class="button red" href="{{ route('applicationinner') }}">Назад</a>
</div>
    <script>
       $(document).ready(function(){
        $(".button_show").click(function(e) {
            e.preventDefault();
            let user_id=$('#user_id').val();
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