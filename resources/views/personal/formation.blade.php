@extends('templateinner')

@section('content')
<section class="news">
<div class="personal_inner">
    <div class="personal">
    </div>
    <p class="personal_title">Образования</p>
</div>
       <table id="customers">
       <thead>
  <tr>
    <th>Тип образования</th>
    <th>Наименование организации</th>
    <th>Год поступления/окончания, дату прох-я</th>
    <th>Специальность/квалификация</th>
    <th>Наименования курса,семинара</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data as $item)
  <tr>
    <td>{{ $item->typeofeducation->name ?? "" }}</td>
    <td>{{ $item->nameoforganization ?? "" }}</td>    
    <td>{{ $item->dateofentry ?? "" }}</td>
    <td>{{ $item->specialities->name  ?? ""}}</td>
    <td>{{ $item->name ?? "" }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>

@endsection