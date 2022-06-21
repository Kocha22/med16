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

                     <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>1111</title>
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
                            <p class="profile_title">Личный кабинет: </p>
                            <p class="profile_title3"></p>
                        </div>
                        <div class="profile2">
                            <p class="profile_title2">Статус:</p>
                            <p class="profile_title3">
  
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
                    <a  href="{{ route('contestlist') }}" class="btn_sidebar  btn_icon btn_sidebar-7 btn_sidebar-panel3  {{ request()->routeIs('contestlist') ? 'active' : '' }}">
                        <span class="btn_spantext">Объявления о вакансии</span>
                    </a>
                    <a  href="{{ route('contestlist') }}" class="btn_sidebar  btn_icon btn_sidebar-7 btn_sidebar-panel3  {{ request()->routeIs('appoinment') ? 'active' : '' }}">
                        <span class="btn_spantext">Назначения</span>
                    </a>
        
             
                </div>                    
            </div>
            @endif
        <div class="content-right3">
           @yield('content')
        </div>
    </div>
</div>
<script type="text/javascript" src="{{  asset('assets/js/libs.min.js') }}"></script>
<script type="text/javascript" src="{{  asset('assets/js/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>