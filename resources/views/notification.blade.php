@extends('templateinner4')

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
    <th>Раздел</th>
    <th>Текст уведомления</th>
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
    @if($sign == 14)
    <tr>
      <td>{{ $note->department_id ?? '' }}</td>
      <td>{{ $note->message ?? '' }}</td>
      <td>
      <div class="button-submit"> 
        <a class="button_10 btn btn-info" href="{{ route('note3', ['post_id'=> $note->id]) }}" name="but1">Подробнее</a>
      </div>
      </td> 
    </tr>
    @endif
    @foreach($comments as $item)
    <tr>
    <td>{{ $item->title ?? ""  }}</td>
    <td>{{ $item->description ?? "" }}</td>
    <td>
    <div class="button-submit"> 
      <a class="button_10 btn btn-info" href="{{ route('note2', ['post_id'=> $item->id ?? '' ]) }}" name="but1">Подробнее</a>
    </div>
    </td>  
    </tr>
    @endforeach  
    @foreach($posts as $post)
    <tr>
      <td>Вакансия</td>
      <td>Объявляется конкурс на замещение должности {{ $post->positions->name ?? "" }}, {{ $post->departments->name ?? "" }}, для участия просим до {{ $post->date_app ?? "" }} подать...</td>
      <td>
      <div class="button-submit"> 
        <a class="button_10 btn btn-info" href="{{ route('note', ['post_id'=> $post->id]) }}" name="but1">Подробнее</a>
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
  var disbledBtn = localStorage.getItem('disabled'); // get the id from localStorage
  $(disbledBtn).attr("disabled", true); // set the attribute by the id

  $('.btn_red').on('click', function(e) {
      let url = $(this).attr('data-url');
      var that = this;
      var id = $(that).attr("disabled", true);
      localStorage.setItem('disabled', 'id'); 
      $.ajax({
        url: url,
        method:'GET',
        dataType:'json',
        success:function(data)
        {
          console.log('Hello');
        }        
  });
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
});
</script>
 @endsection