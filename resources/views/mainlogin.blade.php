@extends('templatemain')

@section('content')
<div class="form_top-title">
    <h2 class="form_top-text2">Министерство здравоохранения Кыргызской Республики</h2>
 </div>
<div class="wrapper_bg">
 </div>
<div class="form-wrap">
   
    
    <div class="form-wrap22">
        <div class="form-home22 mainlogin">
        <div class="sidebar_top22 sidebar_main">
            <a href="{{ route('organizations5') }}" class="btn_sidebar_main btn_org main_title">Перечень организаций здравоохранения<br> Кыргызской Республики</a>
            <a href="{{ route('application') }}"  class="btn_sidebar_main btn_org-2 main_title">Резерв кадров руководителей<br> организаций здравоохранения</a>
            <a href="{{ route('auth.get.register') }}" class="btn_sidebar_main btn_org-3  main_title">Пройти регистрацию</a>
            <a href="{{ route('auth.get.login') }}" class="btn_sidebar_main btn_org-4 main_title">Войти в личный кабинет</a>
        </div>

        </div>
    </div>
</div>         
@endsection