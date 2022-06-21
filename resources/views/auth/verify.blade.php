@extends('templateinner5')

@section('content')
<div class="form_app-inner2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Подтвердите Ваш email-адрес</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Новая ссылка подтверждения отправлена на Ваш адрес электронной почты.
                        </div>
                    @endif

                    Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для подтверждения.
                    Если Вы не получили письмо
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">нажмите здесь для запроса другой ссылки</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection