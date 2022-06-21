@extends('templateinner4')

@section('content')
<style>    
.select2-container--default .select2-selection--single{
    padding:6px;
    height: 37px;
    width: 560px; 
    font-size: 13px; 
    background: #d9e2f3;
    border: 1px solid #194B46 !important; 
    position: relative;
}
</style>
<div class="form_applicant">
<div class="personal_inner">
    <p class="personal_title">Дополнительное профессиональное образование.</p>
    <div class="alert_inner_item">                           
    <input id="applicant_code" class="form__input3 post__title3" type="text" name="applicant_code" value="Заявление №{{ $post->applicant_code ?? ''}}" readonly="readonly">
    </div>
</div>
<form id="form_app2" action="{{ route('storeformation') }}" method="post">
{{ csrf_field() }}
<input type="hidden" name="user_id" value="{{ $user_id ?? '' }}">
<input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
           <div class="form-div">
                    <div>
                        <div class="form_item2">
                            <div class="label_title2"><label for="kindeducation">Направление подготовки</label></div>
                            <div class="alert_inner">                           
                            <select id='' name="kind_education_id" class="choice kind form__input4 post__title4">
                            <option value="0">Выберите из списка</option>
                            @foreach ($kinds as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text kind_education_id_error"></span>
                            </div>
                        </div>
                        <div class="form_item2">
                            <div class='label_title2' id="kindeeducation2" style="display:none;">
                               <div class="kind_medic"></div>
                            </div>
                            <div class="alert_inner">                           
                            <select id='result' name="speciality_id" class="choice2 form__input4 post__title4" style="display:none;">
                            <option value="0">Выберите специальность</option>

                            </select>
                            <span class="text-danger error-text speciality_id_error"></span>
                            </div>
                        </div>
                        <div class="form_item2">
                            <div class="label_title2"><label for="nameoforganization">Полное наименование образовательной организации</label></div>
                            <div class="alert_inner">                           
                            <input id="nameoforganization" class="form__input4 post__title4" type="text" name="nameoforganization"> 
                            <span class="text-danger error-text nameoforganization_error"></span>                           
                            </div>
                        </div>
                        <div class="form_item2">
                            <div class="label_title2"><label for="faculty">Факультет</label></div>
                            <div class="alert_inner">                           
                            <input id="faculty" class="form__input4 post__title4" type="text" name="faculty"> 
                            <span class="text-danger error-text nameoforganization_error"></span>                           
                            </div>
                        </div>
                         
                    </div>
                </div>
                <div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
				<div class="button-submit">                
				<input id="btn" class="button light-blue" type="submit" value="Добавить">               
                </div>
			</form>
            <div id="res"></div>
            <a class="button button_next" href="{{ route('createexperience', ['user_id'=>$user_id]) }}">Сохранить и далее</a>
    <div class="form-home26">
    <table id="customers_next">                
                <thead>
                    <tr>
                    <th>Вид образования</th>
                    <th>Полное наименование организации</th>
                    <th>Ординатура</th>
                    <th>Год поступления</th>
                    <th>Год окончания</th>                    
                    <th>Специальность</th>
                    <th>Файл</th>
                    <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody id="div"></tbody>
    </table>   
    </div>
    </div>

    <div class="modal hide fade modal_show3" id="practice_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="color_id2" name="color_id" value="">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
          <form id="edu_form">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user_id ?? '' }}">
            <input type="hidden" id="post_id" value="{{ $post->id  ?? '' }}">
           <div class="form-table">
                    <div>
                        <div class="form_item2">
                            <div  class="label_title2"><label for="kindeducation">Направление подготовки</label></div>
                            <div class="alert_inner">                           
                            <select id='' name="kind_education_id" class="choice kind form__input6 post__title6">
                            <option value="0">Выберите из списка</option>
                            @foreach ($kinds as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text kind_education_id_error"></span>
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div  class="label_title2" id="kindeeducation2" style="display:none">
                               <div class="kind_medic"></div>
                            </div>
                            <div class="alert_inner">                           
                            <select id='result' name="speciality_id" class="choice2 form__input6 post__title6" style="display:none;">
                            <option value="0">Выберите специальность</option>

                            </select>
                            <span class="text-danger error-text speciality_id_error"></span>
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="nameoforganization">Полное наименование образовательной организации</label></div>
                            <div class="alert_inner">                           
                            <input id="nameoforganization2" class="form__input6 post__title6" type="text" name="nameoforganization" value=""> 
                            <span class="text-danger error-text nameoforganization_error"></span>                           
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="faculty">Факультет</label></div>
                            <div class="alert_inner">                           
                            <input id="faculty2" class="form__input6 post__title6" type="text" name="faculty"  value=""> 
                            <span class="text-danger error-text nameoforganization_error"></span>                           
                            </div>
                        </div>                         
                </div>
                </div>
                <div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
				<div class="button-submit">                
				<button type="submit" id="submit" name="submit" class="">Отправить</button>        
                </div>
			</form>
    

          </div>
        </div>
      </div>
    </div>
    <script>
    $(document).ready(function(){
        $('#kindeeducation2').attr("display", "none");

        let post_id = $('#post_id').val();
        fetch_customer_data()
        function fetch_customer_data()
        {
          $.ajax({
          url:"/ruccessaction/"+post_id,
          method:'GET',
          dataType:'json',
          success:function(response)
          {
            if(response.post_o == 5 || response.post_o == 8 || response.post_o == 13) {
              $('.form__input4').prop('disabled', true);
              $('select').prop('disabled', true);
            } else if (response.post_o == 9) {
              $('.form__input4').prop('disabled', false);
              $('select').prop('disabled', false);
            }
            
          }
          });
          } 


        $(".kind").on('change', function(e) {
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
            url: "/kindeducation/"+id,
            data:   {
                id: id,
                },
            method:'GET',
            dataType:'json',
            success: function(data){
                if(data.table_data =='' || data.table_data ==0 || data.label ==0 ) {
                    $('#kindeeducation2').fadeOut();
                    $('#result').fadeOut();
                    $('#result').select2('destroy');
                } else {
                    $('#kindeeducation2').fadeIn();
                    $('#result').fadeIn();
                    $('#result').select2();
                    $('#kindeeducation2').html(data.label);   
                    $('#result').html(data.table_data);    
                }        
            }
            });

        });
        
        $('.choiceEducation').select2();
        function showdata() {
            $.ajax({
                    url:"{{ route('ajaxproductionfor', ['user_id'=>$user_id]) }}",
                    method:'GET', 
                    dataType:'json',
                    success: function(data){
                         $("#div").html(data.table_data);
                    }
                });
        }
        showdata();

        $("#form_app2").submit(function(e){
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
                    $("#form_app2").find('span.error-text').text('');
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
                    $("#res").text(success);
                    $("#form_app2")[0].reset();
                    showdata();
                }
            }
            });   
            
        });

        $("#div").on("click", ".delete-icon", function() {
            let post_id = $(this).attr('data-sid');
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
             $.ajax({
                url:"/deleteformation/"+post_id,
                method:"GET",
                dataType:'json',
                success: function(response){
                    let success = response.msg;
                    console.log(response.msg);
                    $("#res").html(success);
                    showdata();
                    }

            });
        });

        $('body').on('click', '#editCompany', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.get('/formation/' + id + '/edit', function (data) {
                $('#color_id2').val(data.data.id);
                $('#nameoforganization2').val(data.data.nameoforganization);
                $('#faculty2').val(data.data.faculty);        
            })
        });

        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var id = $("#color_id2").val();
            var nameoforganization = $("#nameoforganization2").val();
            var faculty = $("#faculty2").val();
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
            url: '/formation/' + id,
            type: "POST",
            data: {
                id: id,
                nameoforganization: nameoforganization,
                faculty: faculty
            },
            dataType: 'json',
            success: function (data) {                    
                        $('#edu_form').trigger("reset");
                        $('#practice_modal').modal('hide');
                        window.location.reload(true);
                    }
                });
        });


    });
    </script>  
@endsection