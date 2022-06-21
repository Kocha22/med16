@extends('template')

@section('content')
<h5 class="applicant_title">Электронная форма заявления</h5>
<div class="personal_inner">
    <div class="personal">
    </div>
    <p class="personal_title">Личные данные</p>
</div>
<form id="form_app" action="{{ route('application.store') }}" method="post">
{{ csrf_field() }}
           <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="application_code">Номер заявления</label></td>
                            <td class="alert_inner">                           
                            <input id="application_code" class="form__input post__title" type="text" name="application_code" value="{{ $date2 }}-{{ $applicant_code }}" >
                            @error('application_code')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            </td>
                        </tr>
                        <tr>
                            <td><label for="date_id">Дата заявления</label></td>
                            <td class="alert_inner">                           
                            <input id="date_id" class="form__input post__title" type="text" name="date_id" value="{{ $date2 }}" disabled>                            
                            </td>
                        </tr>
                        <tr>
                            <td><label for="tin">ИНН</label></td>
                            <td class="alert_inner">                           
                            <input id="tin" class="form__input post__title" type="text" name="tin">
                            @error('tin')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            </td>
                        </tr>
                        <tr>
                            <td><label for="name">ФИО заявлителя</label></td>
                            <td class="alert_inner">                            
                            <input id="name" class="form__input post__title" type="text" name="name">
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </tr>
                        <tr>
                            <td><label for="dateofbirth">Дата рождения</label></td>
                            <td class="alert_inner">                            
                            <input type="date" name="dateofbirthday" class="form-control" placeholder="Date">
                            @error('dateofbirth')
                                <div class="error">{{ $message }}</div>
                            @enderror
                             </td>
                        </tr>
                        <tr>
                            <td><label for="age">Полный возраст</label></td>
                            <td class="alert_inner">                            
                            <input id="age" class="form__input post__title" type="text" name="age">
                            @error('age')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </tr>
                        <tr>
                            <td><label for="area_id">Адрес регистрации</label></td>
                            <td class="alert_inner">                            
                            <select id='sel_depart' name="area_id" class="choice">
                            <option value="">Выберите адрес</option>
                            @foreach ($area as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name_ru }} 
                                    @foreach ($choice->children as $choice)
                                        <option value="{{ $choice->id}}">
                                            {{ $choice->name_ru }}     
                                        
                                        </option>
                                    @endforeach   
                                  
                                </option>
                            @endforeach
                            </select>
                            @error('area_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <select id="rec" name="area_id">
                            <option value='0'>-- Выберите из списка --</option>
                            </select>
                            <select id="rec2" name="area_id">
                            <option value='0'>-- Выберите из списка --</option>
                            </select>
                            <select id="rec3" name="area_id">
                            <option value='0'>-- Выберите из списка --</option>
                            </select>
                            <select id="rec4" name="area_id">
                            <option value='0'>-- Выберите из списка --</option>
                            </select>
                            <span class="text-danger error-text adress_error"></span>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="address">Улица, дом, квартира</label></td>
                            <td class="alert_inner">                            
                            <input id="address" class="form__input post__title" type="text" name="residential_address">
                            @error('address')
                                <div class="error">{{ $message }}</div>
                            @enderror
                             </td>
                        </tr> 
                        <tr>
                            <td><label for="passport">Серия и номер паспорта</label></td>
                            <td class="alert_inner">                            
                            <input id="passport" class="form__input post__title" type="text" name="passport">
                            @error('passport')
                                <div class="error">{{ $message }}</div>
                            @enderror
                             </td>
                        </tr> 
                        <tr>
                            <td><label for="countries">Страна выдачи</label></td>
                            <td class="alert_inner">                           
                            <select id='' name="country_id" class="choice">
                            <option value="">Выберите страну выдачи</option>
                            @foreach ($countries as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name_ru }}
                                </option>
                            @endforeach
                            </select>
                            @error('country_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            </td>
                        </tr> 
                        <tr>
                            <td><label for="homephone">Домашний телефон</label></td>
                            <td class="alert_inner">                            
                            <input id="phone" class="form__input post__title" type="text" name="homephone">
                            @error('phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                             </td>
                        </tr>  
                        <tr>
                            <td><label for="mobilephone">Рабочий телефон</label></td>
                            <td class="alert_inner">                            
                            <input id="phone" class="form__input post__title" type="text" name="mobilephone">
                            @error('mobile')
                                <div class="error">{{ $message }}</div>
                            @enderror
                             </td>
                        </tr>  
                        <tr>
                            <td><label for="email">Адрес электронной почты</label></td>
                            <td class="alert_inner">                            
                            <input id="email" class="form__input post__title" type="text" name="email">
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                             </td>
                        </tr>                        
                    </tbody>
                </table>
                <div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
				<div class="button-submit">                
				<input id="btn" class="button light-blue" type="submit" value="Сохранить и далее">
                </div>
			</form>
            </div>
            </div>
           
        </div>
    </div>

    <script>
   $(document).ready(function(){
    $("#sel_depart").on('change', function(e) {
        $("#rec2").html('<option value="">-- Выберите из списка --</option>');
        $("#rec3").html('<option value="">-- Выберите из списка --</option>');
        $("#rec4").html('<option value="">-- Выберите из списка --</option>');
        e.preventDefault();
        var id = $(this).val();

        // AJAX request 
        $.ajax({
        url: "applistore/"+id,
        data:   {
                            id: id,
                        },
        method:'GET',
        dataType:'json',
        success: function(data){
             console.log(data.table_data);
            $("#rec").html(data.table_data);
        }
        });

    });

    $("#rec").on('change', function(e) {
        e.preventDefault();
        var id = $(this).val();

        // AJAX request 
        $.ajax({
        url: "applistore/"+id,
        data:   {
                            id: id,
                        },
        method:'GET',
        dataType:'json',
        success: function(data){
             console.log(data.table_data);
            $("#rec2").html(data.table_data);
        }
        });

    });
    $("#rec2").on('change', function(e) {
        e.preventDefault();
        var id = $(this).val();

        // AJAX request 
        $.ajax({
        url: "applistore/"+id,
        data:   {
                            id: id,
                        },
        method:'GET',
        dataType:'json',
        success: function(data){            
            console.log(data.table_data);
            $("#rec3").html(data.table_data);
        }
        });

    });
    $("#rec3").on('change', function(e) {
        e.preventDefault();
        var id = $(this).val();

        // AJAX request 
        $.ajax({
        url: "applistore/"+id,
        data:   {
                            id: id,
                        },
        method:'GET',
        dataType:'json',
        success: function(data){            
            console.log(data.table_data);
            $("#rec4").html(data.table_data);
        }
        });

    });


   
                

})

    </script>
@endsection