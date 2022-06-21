@extends('template2')

@section('content')

    <div class="form-wrap24 container py-5">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <form action="{{ route('reset-password') }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
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
                            <h5 class="card-title"> Изменить пароль </h5>
                        </div>

                        <div class="card-body px-4">

                            <input type="hidden" name="email" value="{{ $email }} "/>

                            <div class="form-group py-2">
                                <label> Пароль </label>
                                <input type="password" name="password" class="form-control {{$errors->first('password') ? 'is-invalid' : ''}}" value="{{ old('password') }}" placeholder="Новый пароль">
                                    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group py-2">
                                <label> Потвердите пароль </label>
                                <input type="password" name="confirm_password" class="form-control {{$errors->first('confirm_password') ? 'is-invalid' : ''}}" value="{{ old('confirm_password') }}" placeholder="Потвердите пароль">
                                {!! $errors->first('confirm_password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> Изменить пароль </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection