@extends('templatemain')

@section('content')
    <div class="form-wrap">
        <div class="form-home mainlogin">
        <div class="sidebar_top sidebar_main">
            <a href="{{ route('organizations') }}" class="btn_sidebar">Организация здравоохранения</a>
            <a href="{{ route('application') }}"  class="btn_sidebar">Резерв кадров</a>
            <a href="{{ route('auth.get.register') }}" class="btn_sidebar">Подать заявление</a>
            <a href="{{ route('auth.get.login') }}" class="btn_sidebar">Войти</a>
        </div>

        </div>
    </div>
           
@endsection