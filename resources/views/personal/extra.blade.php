@extends('templateinner')

@section('content')
<section class="news">
<div class="personal_inner">
    <div class="personal">
    </div>
    <p class="personal_title">Дополнительная информация</p>
</div>
       <table id="customers">
       <thead>
  <tr>
    <th>Дополнительная информация</th>
    <th>Вид документа</th>
    <th>Прикрепленный файл</th>
    <th>Дата документа</th>
    <th>Описание</th>
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data as $item)
  <tr>
    <td>{{ $item->text ?? "" }}</td>
    <td>{{ $item->typeofdocuments->name ?? "" }}</td>    
    <td>{{ $item->file ?? "" }}</td>
    <td>{{ $item->dateofdocument ?? "" }}</td>
    <td>{{ $item->desciption ?? "" }}</td>

  </tr>
  @endforeach
  </tbody>
</table>
</section>
</form>
<div class="button-submit">                
<a class="button red" href="{{ route('main') }}">Назад</a>
</div>
@endsection