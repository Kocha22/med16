@extends('template')

@section('content')
<div class="head_inner">
    <h4  class="head_title">Организации здравоохранения</h4>
 </div>
<div class="form-gr">
      <input type="text" id="searchstaff" name="search" class="form-control"  placeholder="Поиск..." />
</div>

<div class='biofarm'>
<table id="customers" class="">
<thead>
  <tr>
    <th>№</th>
    <th>Наименование организации здравоохранения</th>
    <th>Руководитель</th>
    <th>Адрес</th>
    <th>Контакты</th>
    <th>Данные о регистрации</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->id ?? ""  }}</td>
    <td>{{ $post->name ?? ""  }}</td>
    <td>{{ $post->director ?? ""  }}</td>
    <td>{{ $post->address ?? ""  }}</td>
    <td>{{ $post->contact ?? ""  }}</td>
   
    <td>
    <div class="button-submit"> 
    <a class="btn_red red" href="#">Подробнее</a>
    </div>
    </td>
  </tr>
  @endforeach    
</tbody>
</table>
<span class="page_links">{{ $posts->links() }}</span>
</div>
<script>

</script>
@endsection