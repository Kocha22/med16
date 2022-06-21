@extends('templateinner')

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
    <th>ID</th>
    <th>ФИО заявителя</th>
    <th>Наименование организации</th>
    <th>Вакансии</th>
    <th>Рейтинг</th>
    <th>Отправить на тестрирование</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->id ?? ""  }}</td>
    <td>{{ $post->surname ?? ""  }} {{ $post->name ?? ""  }} {{ $post->middle ?? ""  }}</td>
    <td>{{ $post->order }}</td>
    <td>{{ $post->vacancy ?? "" }}</td>
    <td>{{ $post->rating ?? "" }}</td> 
    <td>
    <div class="button-submit"> 
    <a class="btn_red red" href="#">Отправить на тестрование</a>
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