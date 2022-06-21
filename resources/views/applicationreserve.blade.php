@extends('templateinner3')

@section('content')
<div class="form_applicant">
<section class="news">
       <div class="form-gr">
      <input type="text" id="searchapp" name="search" class="form-control"  placeholder="Поиск..." />
      </div>
       <table id="customers_next">
       <thead>
  <tr>
    <th>ID</th>
    <th>ФИО заявителя</th>
    <th>Дата рождения</th>
    <th>Адрес проживания</th>
    <th>Статус</th>
    <th>Просмотр</th>
    <th>Отправить на аттестацию</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->id ?? "" }}</td>
    <td>{{ $post->surname ?? "" }} {{ $post->name ?? "" }} {{ $post->middle ?? "" }}</td>
    <td>{{ $post->dateofbirth ?? "" }}</td>
    <td>{{ $post->residential_address ?? "" }}</td>
    <td>{{ $post->appuserstatus->name ?? "" }}</td>
    <td>
    <div class="action_icons"> 
       <a href="{{ route('showap', ['post_id'=> $post->id]) }}"><input type="submit" title="Показать" class="eye-icon"></a>
    </div>
    </td>
     <td>
    <div class="button-submit"> 
    <a class="btn_red red" href="{{ route('restorereserve', ['post_id'=> $post->id]) }}">Одобрить на резерв</a>
    </div>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
<span class="page_links"></span>
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