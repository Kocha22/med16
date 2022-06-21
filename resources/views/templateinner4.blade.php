<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript">
$(function() {
    $('.formdatepicker').datepicker({
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        onClose: function(dateText, inst) { 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 1));
        }
    });
	$(".formdatepicker").focus(function () {
        $(".ui-datepicker-month").hide();
    });
});
</script>
    <style>
.ui-datepicker-calendar { display: none; }
    </style>


    <title>Document</title>
</head>
<body class="mybody">
<div class="main">
    <div class="main_top2">
       <div class="main_top-title2">
        <p class="main_title">Автоматизированная информационная система "Руководитель организации здравоохранения"</p>
        </div>
    </div>
         <div class="sidebar_bottom2">
         @if (Auth::check())
                 <div class="login_inner">
                     <div class="login_name">
                        <div class="profile">
                            <p class="profile_title">Личный кабинет:</p>
                            <p class="profile_title3">{{ $user->surname ?? "" }} {{ $user->name ?? "" }}</p>
                        </div>
                        <div class="profile2">
                            <p class="profile_title2">Статус:</p>
                            <p class="profile_title3">
                            @foreach($user->roles as $role)
                              {{ $role->name ?? "" }}  
                            @endforeach  
                            </p>
                        </div>
                        <div class="profile_logout">
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                            </form>
                             <a href="{{ route('logout') }}" class="sidebar_btn2" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Выход</a>
                        </div>

                        </div>                           
                     </div>
                 </div>
                 @else
                <a href="{{ route('auth.get.login') }}" class="sidebar_btn2">Войти</a>
                 @endif
        </div>   
    </div>
    <div class="wrapper_inner">
        <div class="sidebar-left">
            <div class="main_top-logo"></div>

            @if(Auth::user()->isAdministrator())
            <div class="sidebar_top">
                <div class="bar">
                    <button class="btn_sidebar btn_sidebar-panel3  {{ request()->routeIs('allusers') ? 'active' : '' }}">
                        <span class="btn_spantext">Администрирование</span>
                    </button>
                    <div class="btn_sidebar-content3 {{ request()->routeIs('allusers') ? 'showis' : 'closeis' }}">
                    <button class="btn_sidebar2">
                       <a class="btn_subtext"  href="{{ route('allusers') }}">Зарегистрированные пользователи</a>
                    </button> 
                    </div>
                
                 </div>
                 <a href="#" class="btn_sidebar btn_icon btn_sidebar-9 btn_spantext">Уведомления</a>
                  <div class="bar">
                  <a class="btn_sidebar btn_icon btn_sidebar-8 btn_sidebar-panel3 {{ request()->routeIs('applicationreserve') ? 'active' : '' }}   {{ request()->routeIs('main') ? 'active' : '' }}" href="{{ route('main') }}">
                        Заявления
                    </a>
                
                </div>
                
                <a href="{{ route('applicationinner') }}" class="btn_sidebar btn_spantext {{ request()->routeIs('applicationinner') ? 'active' : '' }}">Резерв кадров</a>
                <a href="{{ route('study') }}" class="btn_sidebar btn_icon btn_sidebar-9 btn_spantext {{ request()->routeIs('study') ? 'active' : '' }}">Список на аттестацию</a>
                <a href="{{ route('retraine') }}" class="btn_sidebar btn_icon btn_sidebar-9 btn_spantext {{ request()->routeIs('retraine') ? 'active' : '' }}">Список на переподготовку</a>
                <a href="{{ route('applicationattestation') }}" class="btn_sidebar btn_spantext {{ request()->routeIs('applicationattestation') ? 'active' : '' }}">Результат (аттестация, переподготовка)</a>
                <a href="{{ route('offer') }}" class="btn_sidebar btn_spantext {{ request()->routeIs('offer') ? 'active' : '' }}">Предложение перевода</a>
                                 <div class="bar">
                    <button class="btn_sidebar btn_icon btn_sidebar-8 btn_sidebar-panel3 {{ request()->routeIs('contestlist') ? 'active' : '' }}   {{ request()->routeIs('contestlist') ? 'active' : '' }}">
                        <span class="btn_spantext ">Конкурс</span>
                    </button>
                    <div class="btn_sidebar-content3 {{ request()->routeIs('contestlist') ? 'showis' : 'closeis' }} {{ request()->routeIs('appointment') ? 'showis' : 'closeis' }}">
                    <button class="btn_sidebar2">
                       <a class="btn_subtext" href="{{ route('contestlist') }}">Объявления о вакансии</a>
                    </button> 
                    <button class="btn_sidebar2">
                       <a class="btn_subtext" href="{{ route('appointment') }}">Назначения</a>
                    </button>  
                    </div>
                <a href="{{ route('showagreement') }}" class="btn_sidebar btn_spantext {{ request()->routeIs('showagreement') ? 'active' : '' }}">Направления на согласования</a>
                <a href="#" class="btn_sidebar btn_spantext">Отчеты</a>
                <a href="{{ route('archive') }}" class="btn_sidebar btn_spantext">Архив</a>
                </div>
            @else
                         <div class="sidebar_top">
                 <a href="{{ route('createapplicant') }}" class="btn_sidebar btn_icon btn_sidebar-1  {{ request()->routeIs('createapplicant') ? 'active' : '' }}">Персональные данные</a>
            
                 <a href="{{ route('createeducation', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-2 {{ request()->routeIs('createeducation') ? 'active' : '' }}">Высшее профессиональное образование</a>
  
                 <a href="{{ route('createformation', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-3 {{ request()->routeIs('createformation') ? 'active' : '' }}">Дополнительное профессиональное образование</a>

                 <a href="{{ route('createexperience', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-4 {{ request()->routeIs('createexperience') ? 'active' : '' }}">Опыт работы</a>

                 <a href="{{ route('createextra', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-5 {{ request()->routeIs('createextra') ? 'active' : '' }}">Дополнительная информация</a>

                 <a href="{{ route('showapfor', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-6 {{ request()->routeIs('showapfor') ? 'active' : '' }}">Предварительный просмотр</a>

                 <a href="{{ route('notifications', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-6 {{ request()->routeIs('notifications') ? 'active' : '' }}">Уведомление</a>

                <a href="{{ route('attestation', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-6 {{ request()->routeIs('attestation') ? 'active' : '' }}">Аттестация/Обучение</a>

                <a href="{{ route('transaction', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-6 {{ request()->routeIs('transaction') ? 'active' : '' }}">Предложение перевода</a>

                <a href="{{ route('appcontest', ['user_id' => $user_id]) }}" class="btn_sidebar btn_icon btn_sidebar-6 {{ request()->routeIs('appcontest') ? 'active' : '' }}">Заявка на участие в конкурсе</a>

                </div>
                <div class="sidebar_bg">           
                </div> 
            @endif
            
                   
        </div>
        <div class="content-right">
           @yield('content')
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".btn_sidebar").click(function () {
          // If the clicked element has the active class, remove the active class from EVERY .nav-link>.state element
          if ($(this).hasClass("active")) {
            $(".btn_sidebar").removeClass("active");
          }
          // Else, the element doesn't have the active class, so we remove it from every element before applying it to the element that was clicked
          else {
            $(".btn_sidebar").removeClass("active");
            $(this).addClass("active");
          }
          });
        
        
        $('.btn_sidebar-panel3').click(function() {
            $(this).parent().find('.btn_sidebar-content3').slideDown();
            $(this).parent().find('.btn_sidebar-content3').attr('style', 'display:block');
          })
        
        $(".button_1").click(function(e) {
            e.preventDefault();
            let user_id=$('#user_id').val();
            let url = $(this).attr('data-url');
             $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                success: function(response){
                    let success = '<span class="modal_alert">'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary" href="/auth/dashboard/'+response.user_id+'">'+'Главная'+'</a>'+ '</span>';
                    console.log(response.msg);
                    $("#res").html(success);
                    }

            });
        });

    });
</script> 
<script type="text/javascript" src="{{  asset('assets/js/libs.min.js') }}"></script>
<script type="text/javascript" src="{{  asset('assets/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>