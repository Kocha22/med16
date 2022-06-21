@extends('templateinner3')

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
    <th>ФИО заявителя</th>
    <th>Дата рождения</th>
    <th>Адрес проживания</th>
    <th>Статус</th>
    <th>Просмотр</th>
    <th>Результат аттесттации</th>
    <th>Результат переподготовки</th>
    <th>Рейтинг</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->surname ?? "" }} {{ $post->name ?? "" }} {{ $post->middle ?? "" }}</td>
    <td>{{ $post->dateofbirth ?? "" }}</td>
    <td>{{ $post->residential_address ?? "" }}</td>
    <td id="status_name">{{ $post->subjectName }}</td> 
    <td>
          <div class="action_icons"> 
       <a href="{{ route('showap', ['post_id'=> $post->id]) }}"><input type="submit" title="Показать" class="eye-icon"></a>
        <button id="editCompany" type="button" data-toggle="modal" data-id="{{ $post->id }}"  data-target="#practice_modal"  class="draw-icon"></button>
    </div>
    </td> 
     <td>{{ $post->score_attestation ?? "" }}</td> 
      <td>{{ $post->score_relearning ?? "" }}</td> 
       <td>{{ $post->rating ?? "" }}</td> 
  </tr>
  @endforeach
  </tbody>
</table>
  <div class="modal hide fade modal_show" id="practice_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="color_id" name="color_id" value="">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
          <form id="companydata" class="form-horizontal" role="form" method="post" action="{{ route('conteststore') }}"> 
          {{ csrf_field() }}
          <div class=""> 
          <label for="name" class="col-sm-3 control-label">
          Результат аттесттации:</label> 
          <div class="alert_inner3"> 
          <input type="text" class="form-control" id="title" name="score_attestation" value=""> 
          </div> 
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Результат переподготовки:</label> 
          <div class=""> 
          <div class="alert_inner3">                            
              <input type="text" class="form-control" id="title2" name="score_relearning" value=""> 
              <span class="text-danger error-text organization_id_error"></span>
          </div> 
          <div class="form-group"> 
          <label for="message" class="col-sm-3 control-label">
          Рейтинг:</label> 
          <div class=""> 
          <div class="alert_inner3">                            
                <input type="text" class="form-control" id="title3" name="rating" value=""> 
                <span class="text-danger error-text position_id_error"></span>
          </div> 
          </div> 
        

          <div class=""> 
          <div class=""> 
            <div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
</div>
          <button type="submit" id="submit" name="submit" class="">Отправить</button> 
          <div id="res"></div>
          </div> 
          </div> 
          <!--end Form--></form>         

          </div>
        </div>
      </div>
    </div>
</section>
<span class="page_links"></span>
</div>

<script>
$(document).ready(function(){
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    
  $(document).on('keyup', '#searchapp', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });


 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.appaction') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
   }
  })
 } 
 
 $('body').on('click', '#editCompany', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.get('color/' + id + '/edit', function (data) {
         $('#color_id').val(data.data.id);
         $('#title').val(data.data.score_attestation);
         $('#title2').val(data.data.score_relearning);
         $('#title3').val(data.data.rating);
         
     })
});

$('body').on('click', '#submit', function (event) {
    event.preventDefault()
    var id = $("#color_id").val();
    var score_attestation = $("#title").val();
    var score_relearning = $("#title2").val();
    var rating = $("#title3").val();
   
    $.ajax({
      url: 'color/' + id,
      type: "POST",
      data: {
        id: id,
        score_attestation: score_attestation,
        score_relearning: score_relearning,
        rating: rating
      },
      dataType: 'json',
      success: function (data) {
          
          $('#companydata').trigger("reset");
          $('#practice_modal').modal('hide');
          window.location.reload(true);
      }
  });
});
 
 
});
</script>
 @endsection