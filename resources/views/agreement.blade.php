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
    <th>Одобрено</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->surname }} {{ $post->name }} {{ $post->middle }}</td>
    <td>{{ $post->dateofbirth }}</td>
    <td>{{ $post->residential_address }}</td>
    <td>{{ $post->appstatuses->name }}</td>    
    <td>
    <div class="action_icons"> 
    <a href="{{ route('showap', ['post_id'=> $post->id]) }}"><input type="submit" title="Показать" class="eye-icon"></a>
    </div>
    </td>
    <td>
    <div class="agreement_inner">
        <div class="agreed">
        <label for="surname">Министерство здравоохранения</label>
        <input type="file" name="file">
        </div>
        <div class="agreed">
        <label for="surname">Местная администрация</label>
        <input type="file" name="file3">
        </div>
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