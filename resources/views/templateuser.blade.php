<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <title>Document</title>
</head>
<body>
<div class="main">
    <div class="main_top">
        <div class="main_top-title">
        <h4 class="main_title">Автоматизированная информационная система "Руководитель организации здравоохранения"</h4>
        </div>
         <div class="sidebar_bottom2">
                 @if (Auth::check())
                    <a href="{{ route('logout') }}" class="sidebar_btn2">Выход</a>
                 @else
                <a href="{{ route('auth.get.login') }}" class="sidebar_btn2">Войти</a>
                 @endif
        </div>   
    </div>
    <div class="wrapper_inner">
        <div class="sidebar-left">
            <div class="sidebar_top">
               <a href="{{ route('organizations') }}" class="btn_sidebar">Организация здравоохранения</a>
                <a href="{{ route('application') }}"  class="btn_sidebar">Резерв кадров</a>
                <a href="{{ route('profile', ['user_id' => $user_id]) }}" class="btn_sidebar">Личные данные</a>
                <a href="{{ route('educationuser', ['user_id' => $user_id]) }}" class="btn_sidebar">Образование</a>
                <a href="{{ route('formationuser', ['user_id' => $user_id]) }}" class="btn_sidebar">Дополнительное образование</a>
                <a href="{{ route('attestationuser', ['user_id' => $user_id]) }}" class="btn_sidebar">Аттестация</a>
                <a href="{{ route('extrauser', ['user_id' => $user_id]) }}" class="btn_sidebar">Дополнительная информация</a>
                <a href="{{ route('experienceuser', ['user_id' => $user_id]) }}" class="btn_sidebar">Опыт работы</a>

 
               
            </div>
            <div class="sidebar_bg">                
            </div>
             
        </div>
        <div class="content-right">
           @yield('content')
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('public/assets/js/libs.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/js/main.js') }}"></script>
</body>
</html>