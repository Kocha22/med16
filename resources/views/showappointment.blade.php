@extends('templateinner6')

@section('content')
<div class="form_applicant">
      
<ul class="nav nav-pills contest_list">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#description">Вскрытие участников</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#characteristics">Протокол</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#opinion">Согласование</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#notification">Назначение</a>
  </li>
</ul>
<div class="tab-content">
  <div class="tab-pane fade show active" id="description">
    <div class="biofarm23">
    <ul>
        <li class="contest_list-info">
            <div class="date_time">Дата</div>
            <div class="date_time-text">{{ $post->created_at }}</div>
        </li>
        <li class="contest_list-info">
            <div class="org">Организация</div>
            <div class="org_info">{{ $post->departments->name }}</div>
        </li>
        <li class="contest_list-info">
            <div class="position">Должность</div>
            <div class="position_info"> {{ $post->positions->name }}</div>
        </li>
        <li class="contest_list-info">
            <div class="quantity">Количество участников</div>
            <div class="quantity_info">20</div>
        </li>
        
    </ul>
    </div>
  </div>
  <div class="tab-pane fade" id="characteristics">
  <div class='biofarm23'>
  <form id="form_app_note" autocomplete="false" action="{{ route('storeappointment') }}" method="post">
{{ csrf_field() }}
<input id="post_id" type="hidden" name="post_id" value="{{ $post->id }}">
           <div autocomplete="off" class="form-table_inner">
                    <div class="form_group-app">                      
                        <div class="form_item">
                            <div  class="label_title"><label for="applicant_code">Дата</label></div>
                            <div class="alert_inner_item">                           
                            <input  type="text" id="datepicker" class="datepicker form__input3 post__title3" type="text" name="date_id">                        

                            </div>
                        </div>
                        <div  class="form_item">
                            <div  class="label_title"><label for="date_id">Номер протокола</label></div>
                            <div class="alert_inner_item">                           
                            <input class="form__input3 post__title3" type="text" name="number_protocol" >                            
                            </div>
                        </div> 
                        <div  class="form_item">
                            <div  class="label_title"><label for="date_id">Победитель</label></div>
                            <div class="alert_inner_item">                           
                            <input class="form__input3 post__title3" type="text" name="winner" >                            
                            </div>
                        </div> 
                        <div  class="form_item">
                            <div  class="label_title"><label for="date_id">Краткое описание по протоколу</label></div>
                            <div class="alert_inner_item">                           
                            <input class="form__input3 post__title3" type="text" name="short_description">                            
                            </div>
                        </div> 
                        <div  class="form_item">
                            <div  class="label_title"><label for="date_id">Загрузить протокол</label></div>
                            <div class="alert_inner_item">                           
                            <input class="form__input3 post__title3" type="file" name="file">                            
                            </div>
                        </div> 
                </div>
                </div>
                <div class="button-submit">                
				<input id="btn" class="button light-blue" type="submit" value="Сохранить">
                </div>
            </form>
  </div>
  <div class="tab-pane fade" id="opinion">
  <div class='biofarm23'>

</div>
</div> 

<div class="tab-pane fade" id="notification">


</div> 
<div id="#res"></div>

</div>

 <script>
       $(document).ready(function(){
        $("#form_app_note").submit(function(e){
             e.preventDefault();
             let id= $('#post_id').val();
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
                    $("#form_app_note").find('span.error-text').text('');
                    $('#loaderIcon').attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                   let success = '<span>'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary"   href="/auth/showappointment/'+id+'">'+'Назад'+'</a>'+ '</span>';
                    console.log(response.msg);
                    $('#res').html(success); 
                    $('#pendingLeaveRequest').modal('show');
                }
            }
            });   
            
        });    
        
            
        })
</script>
@endsection