@extends('templateinner6')

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
    <th>Организация</th>
    <th>Должность</th>
    <th>Электронный адресс</th>
    <th>Статус</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
  <tr>
    <td>{{ $post->id }}</td>
    <td>{{ $post->surname ?? "" }} {{ $post->name ?? "" }} {{ $post->middle ?? "" }}</td>
    <td></td>
    @foreach($post->roles as $item)
    <td>
        {{ $item->name ?? "" }}
    </td>
    @endforeach
    <td>{{ $post->email }}</td>
    <td></td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
<span class="page_links">{{ $posts->links() }}</span>
</div>
 @endsection