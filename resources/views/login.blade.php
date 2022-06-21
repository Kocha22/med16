@extends('template2')

@section('content')

<div class="form-wrap24">
     <div class="main_login-title">
    <h1 class="title-login">Вход в личный кабинет</h1>
    </div>
        <div class="form-home25 mainlogin">
            @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif
            <form id="login-form" action="{{ route('auth.post.login') }}" method="post">
            {{ csrf_field() }}
            <div>
                <input type="email"  class="input_register2" name="email" placeholder="Электронный адрес">
            </div>
            <div>
                <input type="password" class="input_register2" name="password" placeholder="Пароль">
            </div>
            <div>
                <input class="button" type="submit" value="Войти в личный кабинет">
            </div>
            </form>
            <div class="button-submit">                
            <a class="button button_green" href="{{ route('organizations5') }}">Вернуться на главную страницу</a>
            </div>
            <div class="form-group text-end">
                    <a href="{{ route('forgot-password') }}" class="nav-link"> Забыли пароль?</a>
            </div>

    </div>
</div>
@endsection
