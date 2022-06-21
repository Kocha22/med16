@extends('templateinner')

@section('content')
<div class="personal_inner">
    <div class="personal">
    </div>
    <p class="personal_title">Аттестация</p>
</div>
<form id="form_app4" action="{{ route('storeattestation') }}" method="post">
{{ csrf_field() }}
<input type="hidden" name="user_id" value="{{ $user_id }}">
           <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="dateofentry">Дата прохождения</label></td>
                            <td class="alert_inner">                            
                            <input type="text" name="dateofentry" class="terdatepicker form-control">
                             <span class="text-danger error-text dateofentry_error"></span>
                             </td>
                        </tr> 
                        <tr>
                            <td><label for="qualification_id">Присвоенная квалификация</label></td>
                            <td class="alert_inner">                           
                            <select id='' name="qualification_id" class="choice">
                            <option value="">Введите квалификацию</option>
                            @foreach ($positions as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text qualification_id_error"></span>
                            </td>
                        </tr> 
                        <tr>
                            <td><label for="careertarget">Тест</label></td>
                            <td class="alert_inner">                            
                            <input type="text" name="careertarget" class="form-control">
                            <span class="text-danger error-text careertarget_error"></span>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="careergrowth">Тест 2</label></td>
                            <td class="alert_inner">                            
                            <input type="text" name="careergrowth" class="form-control">
                            <span class="text-danger error-text careergrowth_error"></span>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="typeofdocument_id">Вид документа</label></td>
                            <td class="alert_inner">                           
                            <select id='' name="typeofdocument_id" class="choice">
                            <option value="">Введите вид документа</option>
                            @foreach ($type as $choice)
                                <option value="{{ $choice->id}}">
                                    {{ $choice->name }}
                                </option>
                            @endforeach
                            </select>
                            <span class="text-danger error-text typeofdocument_id_error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="nameofdocument">Наименование документа</label></td>
                            <td class="alert_inner">                            
                            <input type="text" name="nameofdocument" class="form-control">
                            <span class="text-danger error-text nameofdocument_error"></span>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="nameofdocument">Причина подачи</label></td>
                            <td class="alert_inner">                            
                            <input type="text" name="nameofdocument" class="form-control" title="по ходатайству и название организации, по самовыдвижению" placeholder="по ходатайству и название организации, по самовыдвижению">
                            <span class="text-danger error-text nameofdocument_error"></span>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="file">Файл</label></td>
                            <td class="alert_inner">                            
                            <input type="file" id="file" name="file" class="form-control">
                            <span class="text-danger error-text file_error"></span>
                             </td>
                        </tr>                                                  
                    </tbody>
                </table>
                <div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
				<div class="button-submit">                
				<input id="btn" class="button light-blue" type="submit" value="Добавить">                
                </div>
			</form>
            <div id="res"></div>
    <div class="form-home2">
    <table id="customers">                
                <thead>
                    <tr>
                    <th>Вид документа</th>
                    <th>Наименование документа</th>
                    <th>Прикрепленный файл</th>
                    <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                    </table>   
    </div>
    <a class="button red" href="{{ route('createextra', ['user_id'=>$user_id]) }}">Сохранить и далее</a>

    <script>
    $(document).ready(function(){
        function showdata() {
            $.ajax({
                    url:"{{ route('ajaxproduction3', ['user_id'=>$user_id]) }}",
                    method:'GET', 
                    dataType:'json',
                    success: function(data){
                         $("#tbody").html(data.table_data);
                    }
                });
        }
        showdata();

        $("#form_app4").submit(function(e){
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
                    $("#form_app4").find('span.error-text').text('');
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
                    $("#form_app4")[0].reset();
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
                url:"/deleteproduction3/"+post_id,
                method:"GET",
                dataType:'json',
                success: function(response){
                    let success = response.msg;
                    $("#res").html(success);
                    showdata();
                    }

            });
        });


    });
    </script> 
@endsection