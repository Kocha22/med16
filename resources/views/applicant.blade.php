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
    <th>Дата заявления</th>
    <th>Представлен в МЗ</th>
    <th>Стадия</th>
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->surname ?? "" }} {{ $post->name ?? "" }} {{ $post->middle ?? "" }}</td>
    <td>{{ $post->updated_at ?? "" }}</td>
    <td>{{ $post->address ?? ""  }} {{ $post->residential_address ?? "" }}</td>
    <td>{{ $post->appuserstatus->name ?? "" }}</td>
    <td>
    <div class="action_icons"> 
    <a href="{{ route('showapp', ['post_id'=> $post->id]) }}"><input type="submit" title="Показать" class="eye-icon"></a>
    </div>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
<span class="page_links"></span>
</div>
 @endsection