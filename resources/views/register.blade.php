@extends('template')

@section('content')
<div class="form_table">
    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
    @endif    
    <form action="{{ route('postregister') }}" method="post">
    {{ csrf_field() }}
    <div>
        <input type="email" name="email" placeholder="Email">
    </div>
    <div>
        <input type="text" name="name" placeholder="First name">
    </div>
    <div>
        <input type="text" name="surname" placeholder="Last name">
    </div> 
    @can('isLoginSite')
    <div>
        <div><label for="select">Тип пользователя</label></div>
        <div>
            <select name="role_id" class="director">
            @foreach ($roles as $role)
                <option value="{{ $role->id}}">{{ $role->name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    @endcan
    @can('update-post')
    <div>
        <div><label for="select">Тип пользователя</label></div>
        <div>
            <select name="role_id" class="director">
            @foreach ($roles as $role)
                <option value="{{ $role->id}}">{{ $role->name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    @endcan
    <div>
        <input type="text" name="age" placeholder="Age">
    </div>
    <div>
        <input type="text" name="city" placeholder="City">
    </div>
    <div>
        <input type="password" name="password" placeholder="Password">
    </div>
    <div>
        <input type="submit" value="Зарегистрироваться">
    </div>
    </form>
</div>
@endsection
