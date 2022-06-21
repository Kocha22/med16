@extends('template2')

@section('content')

    <div class="form-wrap24 container2 py-5">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
                <form action="{{ route('forgot-password2') }}" method="post" autocomplete="off">
                    @csrf
                       <div class="card shadow">

                        @if (Session::has("success"))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ Session::get('success') }}
                            </div>
                        @elseif (Session::has("failed"))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ Session::get('failed') }}
                            </div>
                        @endif

                        <div class="card-header">
                            <h5 class="card-title"> Забыли пароль </h5>
                        </div>

                        <div class="card-body px-4">
                            <div class="form-group py-2">
                                <label> Email </label>
                                <input type="email" name="email" class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}" value="{{ old('email') }}" placeholder="Ваша электронная почта">
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group text-end">
                                <a href="{{ route('auth.get.login') }}" class="nav-link"> Назад</a>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> Сброс пароля </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
