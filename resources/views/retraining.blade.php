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
    <th>Организация</th>
    <th>Должность</th>
    <th>Просмотр</th>
    <th>Статус</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->surname }} {{ $post->name }} {{ $post->middle }}</td>
    <td>{{ $post->order ?? "" }}</td>
    <td>{{ $post->position ?? "" }}</td>
     <td>
     <div class="action_icons"> 
    <a href="{{ route('showap2', ['post_id'=> $post->id]) }}"><input type="submit" title="Показать" class="eye-icon"></a>
    </div>
    </td>
    <td>{{ $post->subjectName ?? "" }}</td>
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