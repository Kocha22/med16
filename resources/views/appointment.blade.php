@extends('templateinner6')

@section('content')
<div class="form_applicant">
<section class="news">
  <div class="form-gr" id="post_id">

      <input type="text" id="searchstaff" name="search" class="form-control"  placeholder="Поиск..." />
      <div class="button-submit">                
        <input id="btn" class="button light-blue" type="submit" value="Поиск">                
                </div>

      </div>
       <table id="customers_next">
       <thead>
  <tr>
    <th>Организация</th>
    <th>Должность</th>
    <th>Срок подачи заявки</th>
    <th>Статус</th>
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->departments->name ?? "" }}</td>
    <td>{{ $post->positions->name ?? "" }}</td>
    <td>{{ $post->date_app ?? "" }}</td>
    <td>{{ $post->status ?? ""}}</td>
    <td>
    <div class="action_icons"> 
    <a href="{{ route('showappointment', ['id'=> $post->id]) }}"><input type="submit" title="Показать" class="eye-icon"></a>
    </div>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>


</div>
<script>
       $(document).ready(function(){
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
                    $('#loaderIcon').attr('style', 'display:block');
                },
                success:function (response) {
                if(response.code != 200){
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                   let success = '<span>'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary"   href="/auth/contestlist">'+'Назад'+'</a>'+ '</span>';
                    console.log(response.msg);
                    $('#leave_details').html(success); 
                    $('#pendingLeaveRequest').modal('show');
                }
            }
            });   
            
        });    
        
            
        })
</script>
 @endsection