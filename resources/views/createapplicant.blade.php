@extends('templateinner')

@section('content')
<style>    
.select2-container--default .select2-selection--single{
    padding:6px;
    height: 37px;
    width: 289px; 
    font-size: 13px; 
    background: #d9e2f3;
    border: 1px solid #194B46 !important; 
    position: relative;
}
</style>
 @if(Auth::user()->isAdministrator())
    <div></div>
    @else
    <div class="form_applicant">
    <div class="personal_inner">
    <div class="personal_title">Персональные данные</div>
    <button type="button" class="button2 button_next" data-toggle="modal" data-target="#instructions">
    Инструкция по заполнению</button>
    <div class="alert_inner_item">                           
        <input id="applicant_code" class="form__input3 post__title3" type="text" name="applicant_code" value="Заявление №{{ $date2 }}-{{ $applicant_code }}" readonly="readonly">
    </div>
</div>
<div class="form_app-inner">
<form id="form_app" autocomplete="false" action="{{ route('applicant.store') }}" method="post">
{{ csrf_field() }}
<input type="hidden" name="user_id" value="{{ $user_id }}">
           <div autocomplete="off" class="form-table_inner">
                    <div class="form_group-app">                      
                        <div class="form_item">
                            <div  class="label_title"><label for="applicant_code">Номер заявления</label></div>
                            <div class="alert_inner_item">                           
                            <input id="applicant_code" class="form__input3 post__title3" type="text" name="applicant_code" value="{{ $date2 }}-{{ $applicant_code }}" readonly="readonly">
                            </div>
                        </div>
                        <div  class="form_item">
                            <div  class="label_title"><label for="date_id">Дата заявления</label></div>
                            <div class="alert_inner_item">                           
                            <input id="datepicker" class="form__input3 post__title3" type="text" name="date_id" value="{{ $date2 }}" disabled>                            
                            </div>
                        </div> 
                        <div  class="form_item">
                            <div  class="label_title"><label for="surname">Фамилия</label></div>
                            <div class="alert_inner_item">                            
                            <input id="surname" class="form__input3 post__title3" type="text" name="surname"   value="{{ $user->surname ?? "" }}">
                            <span class="text-danger error-text surname_error"></span>
                            </div>
                        </div>
                        <div  class="form_item">
                            <div  class="label_title"><label for="name">Имя</label></div>
                            <div class="alert_inner_item">                            
                            <input id="name" class="form__input3 post__title3" type="text" name="name" autocomplete="off"  value="{{ $user->name }}">
                            <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div  class="form_item">
                            <div  class="label_title"><label for="middle">Отчество</label></div>
                            <div class="alert_inner_item">                            
                            <input id="middle" class="form__input3 post__title3" type="text" name="middle" autocomplete="off">
                            <span class="text-danger error-text middle_error"></span>
                            </div>
                        </div>                                        
                        <div  class="form_item">
                            <div  class="label_title"><label for="dateofbirth">Дата рождения</label></div>
                            <div class="alert_inner_item">                            
                            <input id="date_id" type="text" name="dateofbirth" class="datepicker form__input3 post__title3" autocomplette="off">
                            <span class="text-danger error-text dateofbirth_error"></span>
                             </div>
                        </div>
                        <div  class="form_item">
                            <div  class="label_title"><label for="age">Полный возраст</label></div>
                            <div class="alert_inner_item">                            
                            <input id="result" class="form__input3 post__title3" type="text" name="age" autocomplete="off" readonly>
                            <span class="text-danger error-text age_error"></span>
                            </div>
                        </div>
                       
                        <div  class="form_item">
                            <div  class="label_title"><label for="passport">Серия и номер паспорта</label></div>
                            <div class="alert_inner_item">                            
                            <input id="passport" class="form__input3 post__title3" type="text" name="passport">
                            <span class="text-danger error-text passport_error"></span>
                             </div>
                        </div> 
                        <div  class="form_item">
                            <div  class="label_title"><label for="department">Орган выдачи</label></div>
                            <div class="alert_inner_item">                           
                            <input id="department_id" class="form__input3 post__title3" type="text" name="department" autocomplete="off" >
                            <span class="text-danger error-text department_error"></span>
                            </div>
                        </div>
                        <div  class="form_item">
                            <div  class="label_title"><label for="filename">Скан паспорта</label></div>
                            <div class="alert_inner_item">                            
                            <input type="file" id="filename" name="filename" class="form__input3 post__title3">
                            <span class="text-danger error-text file_error"></span>
                             </div>
                        </div>                          
                        <div  class="form_item">
                            <div  class="label_title"><label for="tin">ПИН</label></div>
                            <div class="alert_inner_item">                           
                            <input id="tin" class="form__input3 post__title3" type="text" name="tin" autocomplete="off">
                            <span class="text-danger error-text tin_error"></span>
                            </div>
                        </div>                       
                        <div  class="form_item">
                            <div  class="label_title"><label for="phone">Рабочий телефон</label></div>
                            <div class="alert_inner_item">                            
                            <input id="phone" class="form__input3 post__title3" type="text" name="phone" autocomplete="off" >
                            <span class="text-danger error-text phone_error"></span>
                             </div>
                        </div>  
                        <div  class="form_item">
                            <div  class="label_title"><label for="email">Адрес электронной почты</label></div>
                            <div class="alert_inner_item">                            
                            <input id="email" class="form__input3 post__title3" type="text" name="email"  value="{{ $user->email }}">
                            <span class="text-danger error-text email_error"></span>
                             </div>
                        </div>                 
                   
                   
                    </div>
                    <div class="form_address-section">
                    <div class="form_address-block">

                        <div class="form_address-item">
                        <div class="residential_address">
                            <div  class="residential_address-text"><div>Адрес по прописке</div> </div>
                        </div> 

                        <div class="flex_block">
                        <div  class="residential_block">
                            <div class="residential_block-text">            
                                <div class="area_id">Область, город:</div>                               
                            </div>
                            <div class="alert_inner3">                            
                            <select id='oblast' name="oblast" class="choice form__input3 post__title3">
                            <option value="">Выберите адрес</option>
                            @foreach ($area as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name_ru }} 
                                                                  
                                </option>
                            @endforeach
                            </select>                  
                            <span class="text-danger error-text oblast_error"></span>
                             </div>
                        </div>
                        <div  class="residential_block">
                            <div class="residential_block-text">            
                                <div class="area_id">Район, город:</div>                               
                            </div>
                            <div class="alert_inner3">                            
                             <select id='rayon' name="rayon" class="choice form__input3 post__title3">
                            </select>
                            <span class="text-danger error-text oblast_error"></span>
                             </div>
                        </div>
                        <div  class="residential_block">
                            <div class="residential_block-text">            
                                <div class="area_id">Село, город:</div>                               
                            </div>
                            <div class="alert_inner3">                            
                            <select id='city' name="city" class="choice form__input3 post__title3">
                            </select>
                            <span class="text-danger error-text oblast_error"></span>
                             </div>
                        </div>

                        </div>
                        
                        <div class="street" autocomplete="off">
                            <div  class="street-text"><div>Улица, дом, квартира</div></div>
                            <div class="alert_inner3">                            
                            <input type="text" autocomplete="off" id="address" class="form__input3 post__title3"  name="address"  >
                            <span class="text-danger error-text adress_error" ></span>
                             </div>
                        </div>
                        </div>


                     
                        <div class="residential_address2">
                            <div  class="residential_address-text2"> <label><input type="checkbox" id="duplicate-address" name="duplicate-address" value="shipping same as billing">&nbsp;&nbsp;Фактически адрес совпадает с адресом по прописке</label></div>
                        </div>
                       

                        <div class="form_address-item">
                        <div class="residential_address">
                            <div  class="residential_address-text"><div>Адрес фактический</div> </div>
                        </div> 

                        <div class="flex_block">
                        <div class="residential_block">
                           <div class="residential_block-text">            
                                <div class="area_id">Область, город:</div>                               
                            </div>
                            <div class="alert_inner3">                            
                            <select id='oblast2' name="oblast2" class="choice form__input3 post__title3">
                            <option value="">Выберите адрес</option>
                            @foreach ($area as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name_ru }} 
                                                                  
                                </option>
                            @endforeach
                            </select>

                            <span class="text-danger error-text oblast2_error"></span>
                             </div>
                        </div>
                        <div class="residential_block">
                           <div class="residential_block-text">            
                                <div class="area_id">Район, город:</div>                               
                            </div>
                            <div class="alert_inner3">                            
                             <select id='rayon2' name="rayon2" class="choice form__input3 post__title3">
                            </select>
                            <span class="text-danger error-text oblast2_error"></span>
                             </div>
                        </div>
                        <div class="residential_block">
                           <div class="residential_block-text">            
                                <div class="area_id">Город, село:</div>                               
                            </div>
                            <div class="alert_inner3">                            
                             <select id='city2' name="city2" class="choice form__input3 post__title3">
                            </select>
                            <span class="text-danger error-text oblast2_error"></span>
                             </div>
                        </div>


                        </div>

                        
                        <div class="street" autocomplete="off">
                            <div  class="street-text"><div>Улица, дом, квартира</div></div>
                            <div class="alert_inner3">                            
                            <input type="text" autocomplete="off" id="address2" class="form__input3 post__title3"   name="address2"  >
                            <span class="text-danger error-text address2_error"></span>
                             </div>
                        </div>
                        </div>
               
                   </div>
                    </div>
                </div>
                <div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
				<div class="button-submit">                
				<input id="btn" class="button light-blue" type="submit" value="Сохранить">
                </div>
			</form>
</div>

            </div>
            </div>
           
        </div>
    </div>
    </div>


    <div id="myModal" class="modal fade show modal_show3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Вы хотите подать заявку?</h5>
            </div>
            <div class="modal-body center">
                <div>
                    <button type="button" class="button button_next" data-dismiss="modal">Да</button>
                    <a class="button button_next center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Нет</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal hide fade modal_show" id="instructions" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Инструкция по заполнению</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body center">
                <div>
                   <ol>
                       <li>Будьте внимательны при заполнении полей. Личная информация заполняется на русском языке (кириллицей). Данные следует указывать согласно вашим личным документам </li>
                   </ol>
                </div>
            </div>
        </div>
    </div>
</div>

    @endif
    <script>
   $(document).ready(function(){ 
        var dialogShown = localStorage.getItem('dialogShown')

        if (!dialogShown) {
            $(window).load(function(){
                $('#myModal').modal('show');
                localStorage.setItem('dialogShown', 1)
            });
        }

        $('#duplicate-address').click(function(e) {
            if( $('#duplicate-address').prop('checked') ){
            $('#oblast2').val($('#oblast option:selected').val());           
            showdata2();
            }
        });

  
       function showdata2() {
        var id = $('#oblast2').val();
        $.ajax({
                url:"appstore2/"+id,
                method:'GET', 
                dataType:'json',
                success: function(data){
                        $("#rayon2").html(data.table_data);   
                        $('#rayon2').val($('#rayon option:selected').val()); 
                        $("#rayon2").attr('style', 'display:block');    
                        if(data.table_data !='') {
                            showdata4();   
                        }               
                }
            });
        }
        showdata2();

 

        function showdata4() {
        var id = $('#rayon2').val();
        $.ajax({
                url:"appstore2/"+id,
                method:'GET', 
                dataType:'json',
                success: function(data){
                        $("#city2").html(data.table_data); 
                        $('#city2').val($('#city option:selected').val());
                         if(data.table_data !='') {
                            $("#city2").attr('style', 'display:block');   
                        }    
                        $('#address2').val($('#address').val());                       
                }
            });
        }


    $('.choice2').select2();
    $(".choice").on('change', function(e) {
        e.preventDefault();
        if($(this).val() != '')
            {
            var action = $(this).attr("id");
            var id = $(this).val();
            var result = '';
            if(action == 'oblast')
            {
                result = 'rayon';
            }
            else if(action == 'rayon')
            {
                result = 'city';
            }
            else if(action == 'oblast2')
            {
                result = 'rayon2';
            }
            else if(action == 'rayon2')
            {
                result = 'city2';
            }
        // AJAX request 
        $.ajax({
        url: "appstore2/"+id,
        data:   {
            action:action,
            id: id,
            },
        method:'GET',
        dataType:'json',
        success: function(data){
            if(data.table_data =='') {
                $('#'+result).html(data.table_data); 
            } else {         
             $('#'+result).select2();
             $('#'+result).html(data.table_data);    
            }        
        }
        });

    }});

    $("#form_app").submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: url, 
                data: formData,
                cache:false,
                dataType:'json',
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $("#form_app").find('span.error-text').text('');
                },
                success:function (response) {
                if(response.code != 200){
                    console.log(response);
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    let success = response.msg;
                    console.log(success);
                    window.location.href = "/createeducation/"+response.user_id;
                }
            }
            });   
            
        });

})

    </script>
@endsection