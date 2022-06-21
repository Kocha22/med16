@extends('templateinner2')

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
    <p class="personal_title">Опыт работы</p>
    <div class="alert_inner_item">                           
    <input id="applicant_code" class="form__input3 post__title3" type="text" name="applicant_code" value="Заявление №{{ $post->applicant_code ?? '' }}" readonly="readonly">
    </div>
</div>
<form id="form_app2" action="{{ route('storeexperience') }}" method="post">
{{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user_id ?? '' }}">
            <input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
           <div class="form-table">
                    <div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="organization">Полное наименование организации</label></div>
                            <div class="alert_inner">                           
                            <select id='' name="organization_id" class="choice2 form__input4 post__title4">
                            <option value="">Выберите организацию</option>
                            @foreach ($organizations as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text organization_id_error"></span>
                            </div>
                        </div> 
                        <div  class="form_item2">
                            <div class="label_title2"><label for="position">Должность</label></div>
                            <div class="alert_inner">                           
                            <select id='' name="position_id" class="choice form__input4 post__title4">
                            <option value="">Введите должность</option>
                            @foreach ($positions as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text position_id_error"></span>
                            </div>
                        </div> 
                        <div  class="form_item2">
                            <div class="label_title2"><label for="jobdate">Дата устройства на работу</label></div>
                            <div class="alert_inner">                            
                            <input type="text" name="jobdate" class="terdatepicker form-control form__input4 post__title4">
                             </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="termination">Дата увольнения</label></div>
                            <div class="alert_inner38">                            
                            <input type="text" name="termination" class="terdatepicker form-control form__input5 post__title5">
                             <div style="padding-left:15px;">
                            <input id="nowadays" type="checkbox" name="nowadays" value="1"> По настоящее время 
                             </div>
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="warrant">Номер приказа</label></div>
                            <div class="alert_inner">                           
                            <input id="warrant" class="form__warrant form__input4 post__title4" type="text" name="warrant" disabled="disabled">
                            <span class="text-danger error-text warrant_error"></span>
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="date_order">Дата номера приказа</label></div>
                            <div class="alert_inner">                           
                            <input id="date_order" class="terdatepicker form__warrant form__input4 post__title4" type="text" name="date_order" disabled="disabled">
                            <span class="text-danger error-text warrant_error"></span>
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="begindate">Дата заключения договора</label></div>
                            <div class="alert_inner">                            
                            <input id="begindate" type="text" name="begindate" class="terdatepicker form-control form__input4 post__title4" disabled="disabled"> 
                            <span class="text-danger error-text begindate_error"></span>                          
                             </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="enddate">Дата окончания договора</label></div>
                            <div class="alert_inner">                            
                            <input id="enddate" type="text" name="enddate" class="terdatepicker form-control form__input4 post__title4" disabled="disabled"> 
                            <span class="text-danger error-text enddate_error"></span>                          
                             </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="filename">Файл</label></div>
                            <div class="alert_inner">                            
                            <input type="file" id="filename" name="filename" class="form-control form__input4 post__title4">
                            <span class="text-danger error-text file_error"></span>
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
            <a class="button button_next" href="{{ route('createextra', ['user_id'=>$user_id]) }}">Сохранить и далее</a>
    <div class="form-home26">
    <table id="customers_next">                
                <thead>
                    <div>
                    <th>Наименование организации</th>
                    <th>Должность</th>
                    <th>Дата устройства</th>
                    <th>Дата увольнения</th>
                    <th>Номер приказа</th>
                    <th>Дата заключения</th>
                    <th>Дата окончания</th>
                    <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
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
                        <div  class="form_item2">
                            <div class="label_title2"><label for="organization">Полное наименование организации</label></div>
                            <div class="alert_inner">                           
                            <select id='' name="organization_id" class="choice2 form__input6 post__title6">
                            <option value="">Выберите организацию</option>
                            @foreach ($organizations as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text organization_id_error"></span>
                            </div>
                        </div> 
                        <div  class="form_item2">
                            <div class="label_title2"><label for="position">Должность</label></div>
                            <div class="alert_inner">                           
                            <select id='' name="position_id" class="choice form__input6 post__title6">
                            <option value="">Введите должность</option>
                            @foreach ($positions as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text position_id_error"></span>
                            </div>
                        </div> 
                        <div  class="form_item2">
                            <div class="label_title2"><label for="jobdate">Дата устройства на работу</label></div>
                            <div class="alert_inner">                            
                            <input type="text" id="jobdate" name="jobdate" class="terdatepicker form-control form__input6 post__title6" value="">
                             </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="termination">Дата увольнения</label></div>
                            <div class="alert_inner38">                            
                            <input type="text" id="termination" name="termination" class="terdatepicker form-control form__input6 post__title6"  value="">
                             <div style="padding-left:15px;">
                            <input id="nowadays" type="checkbox" name="nowadays" value="1"> По настоящее время 
                             </div>
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="warrant">Номер приказа</label></div>
                            <div class="alert_inner">                           
                            <input id="warrant" class="form__warrant form__input6 post__title6" type="text" name="warrant" disabled="disabled"  value="">
                            <span class="text-danger error-text warrant_error"></span>
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="date_order">Дата номера приказа</label></div>
                            <div class="alert_inner">                           
                            <input id="date_order" class="terdatepicker form__warrant form__input6 post__title6" type="text" name="date_order" disabled="disabled"  value="">
                            <span class="text-danger error-text warrant_error"></span>
                            </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="begindate">Дата заключения договора</label></div>
                            <div class="alert_inner">                            
                            <input id="begindate" type="text" name="begindate" class="terdatepicker form-control form__input6 post__title6" disabled="disabled"  value=""> 
                            <span class="text-danger error-text begindate_error"></span>                          
                             </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="enddate">Дата окончания договора</label></div>
                            <div class="alert_inner">                            
                            <input id="enddate" type="text" name="enddate" class="terdatepicker form-control form__input6 post__title6" disabled="disabled"  value=""> 
                            <span class="text-danger error-text enddate_error"></span>                          
                             </div>
                        </div>
                        <div  class="form_item2">
                            <div class="label_title2"><label for="filename">Файл</label></div>
                            <div class="alert_inner">                            
                            <input type="file" id="filename" name="filename" class="form-control form__input6 post__title6"  value="">
                            <span class="text-danger error-text file_error"></span>
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
        $('.choice2').select2();
        function showdata() {
            $.ajax({
                    url:"{{ route('ajaxproduction2', ['user_id'=>$user_id]) }}",
                    method:'GET', 
                    dataType:'json',
                    success: function(data){
                         $("#tbody").html(data.table_data);
                    }
                });
        }
        showdata();

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
              $('.form__input5').prop('disabled', true);
              $('select').prop('disabled', true);
            } else if (response.post_o == 9) {
              $('.form__input4').prop('disabled', false);
              $('.form__input5').prop('disabled', false);
              $('select').prop('disabled', false);
            }
            
          }
          });
          } 

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
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    let success = response.msg;
                    $("#res").text(success);
                    $("#form_app2")[0].reset();
                    $("#warrant").prop("disabled", true);
                    $("#date_order").prop("disabled", true);
                    $("#begindate").prop("disabled", true);
                    $("#enddate").prop("disabled", true);
                    showdata();
                }
            }
            });   
            
        });

        $("#tbody").on("click", ".delete-icon", function() {
            let post_id = $(this).attr('data-sid');
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
             $.ajax({
                url:"/deleteproduction2/"+post_id,
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

        document.getElementById('nowadays').onchange = function() {
            document.getElementById('warrant').disabled = !this.checked;
            document.getElementById('date_order').disabled = !this.checked;
            document.getElementById('begindate').disabled = !this.checked;
            document.getElementById('enddate').disabled = !this.checked;
        };

        $('body').on('click', '#editCompany', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.get('/experience/' + id + '/edit', function (data) {
                $('#color_id2').val(data.data.id);
                $('#jobdate').val(data.data.jobdate);
                $('#termination').val(data.data.termination);        
            })
        });

        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var id = $("#color_id2").val();
            var jobdate = $("#jobdate").val();
            var termination = $("#termination").val();
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
            url: '/experience/' + id,
            type: "POST",
            data: {
                id: id,
                jobdate: jobdate,
                termination: termination
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