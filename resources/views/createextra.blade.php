@extends('templateinner')

@section('content')
<div class="form_applicant">
<div class="personal_inner">
    <p class="personal_title">Дополнительная информация</p>
    <div class="alert_inner_item">                           
    <input id="applicant_code" class="form__input3 post__title3" type="text" name="applicant_code" value="Заявление №{{ $post->applicant_code ?? '' }}" readonly="readonly">
    </div>
</div>
<form id="form_app2" action="{{ route('storeextra') }}" method="post">
{{ csrf_field() }}
<input id="user_id" type="hidden" name="user_id" value="{{ $user_id ?? '' }}">
<input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
                <div class="form-table">
                    <div>
                        <div class="form_item2">
                            <div class="label_title2"><label for="text">Дополнительная информация</label></div>
                            <div class="alert_inner">                            
                            <input type="text" name="text" class="form-control form__input4 post__title4">
                             <span class="text-danger error-text text_error"></span>
                             </div>
                        </div> 
                        <div class="form_item2">
                            <div class="label_title2"><label for="typeofextra">Вид документа</label></div>
                            <div class="alert_inner">                            
                            <input type="text" name="typeofextra" class="form-control form__input4 post__title4">
                            <span class="text-danger error-text typeofextra_error"></span>
                             </div>
                        </div> 
                        <div class="form_item2">
                            <div class="label_title2"><label for="file">Файл</label></div>
                            <div class="alert_inner">                            
                            <input type="file" id="file" name="file" class="form-control form__input4 post__title4">
                            <span class="text-danger error-text file_error"></span>
                             </div>
                        </div>   
                        <div class="form_item2">
                            <div class="label_title2"><label for="dateofdocument">Дата прохождения</label></div>
                            <div class="alert_inner">                            
                            <input type="text" name="dateofdocument" class="datepicker form-control form__input4 post__title4" autocomplete="off">
                            <span class="text-danger error-text dateofdocument_error"></span>
                             </div>
                        </div> 
                        <div class="form_item2">
                            <div class="label_title2"><label for="description">Наименование документа</label></div>
                            <div class="alert_inner">                            
                            <input type="text" name="description" class="form-control form__input4 post__title4">
                            <span class="text-danger error-text description_error"></span>
                             </div>i
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
            <a class="button button_next" href="{{ route('showapfor', ['user_id'=>$user_id]) }}">Сохранить и далее</a>     
    <div class="form-home26">
    <table id="customers_next">                
                <thead>
                    <div>
                    <th>Дополнительная информация</th>
                    <th>Вид документа</th>
                    <th>Прикрепленный файл</th>
                    <th>Дата документа</th>
                    <th>Описание</th>
                    <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                    </table>   
    </div>
    <div>
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
                            <div class="label_title2"><label for="text">Дополнительная информация</label></div>
                            <div class="alert_inner">                            
                            <input id="text" type="text" name="text" class="form-control form__input6 post__title6"  value="">
                             <span class="text-danger error-text text_error"></span>
                             </div>
                        </div> 
                        <div class="form_item2">
                            <div class="label_title2"><label for="typeofextra">Вид документа</label></div>
                            <div class="alert_inner">                            
                            <input type="text" id="typeofextra" name="typeofextra" class="form-control form__input6 post__title6"  value="">
                            <span class="text-danger error-text typeofextra_error"></span>
                             </div>
                        </div> 
                        <div class="form_item2">
                            <div class="label_title2"><label for="file">Файл</label></div>
                            <div class="alert_inner">                            
                            <input type="file" id="file" name="file" class="form-control form__input6 post__title6"  value="">
                            <span class="text-danger error-text file_error"></span>
                             </div>
                        </div>   
                        <div class="form_item2">
                            <div class="label_title2"><label for="dateofdocument">Дата прохождения</label></div>
                            <div class="alert_inner">                            
                            <input type="text" id="dateofdocument" name="dateofdocument" class="datepicker form-control form__input6 post__title6" autocomplete="off"  value="">
                            <span class="text-danger error-text dateofdocument_error"></span>
                             </div>
                        </div> 
                        <div class="form_item2">
                            <div class="label_title2"><label for="description">Наименование документа</label></div>
                            <div class="alert_inner">                            
                            <input type="text" id="description" name="description" class="form-control form__input6 post__title6" value="">
                            <span class="text-danger error-text description_error"></span>
                             </div>i
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
        function showdata() {
            $.ajax({
                    url:"{{ route('ajaxproduction4', ['user_id'=>$user_id]) }}",
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
            } else if (response.post_o == 9) {
              $('.form__input4').prop('disabled', false);
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
                     showdata();
                }
            }
            });   
            
        });

         $("tbody").on("click", ".delete-icon", function() {
            let post_id = $(this).attr('data-sid');
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
             $.ajax({
                url:"/deleteproduction4/"+post_id,
                method:"GET",
                dataType:'json',
                success: function(response){
                    let success = response.msg;
                    $("#res").html(success);
                    showdata();
                    }

            });
        });

        $('body').on('click', '#editCompany', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.get('/extra/' + id + '/edit', function (data) {
                $('#color_id2').val(data.data.id);
                $('#text').val(data.data.text);
                $('#typeofextra').val(data.data.typeofextra); 
                $('#file').val(data.data.file);        
                $('#dateofdocument').val(data.data.dateofdocument);        
                $('#description').val(data.data.description);              
            })
        });

        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var id = $("#color_id2").val();
            var text = $("#text").val();
            var typeofextra = $("#typeofextra").val();
            var file = $("#file").val();
            var dateofdocument = $("#dateofdocument").val();
            var description = $("#description").val();
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
            url: '/extra/' + id,
            type: "POST",
            data: {
                id: id,
                text: text,
                typeofextra: typeofextra,
                file:file,
                dateofdocument:dateofdocument,
                description:description
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