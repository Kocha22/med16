@extends('templateinner')

@section('content')
<section class="news">
<div class="personal_inner">
    <div class="personal">
    </div>
    <p class="personal_title">Опыт работы</p>
</div>
       <table id="customers">
       <thead>
  <tr>
    <th>Наименование организации</th>
    <th>Должность</th>
    <th>Дата устройства</th>
    <th>Дата увольнения</th>
    <th>Номер приказа</th>
    <th>Дата заключ-я</th>
    <th>Дата оконч-я</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data as $item)
  <tr>
    <td>{{ $item->organizations->name ?? "" }}</td>
    <td>{{ $item->positions->name ?? "" }}</td>    
    <td>{{ $item->jobdate ?? "" }}</td>
    <td>{{ $item->termination ?? "" }}</td>
    <td>{{ $item->warrant ?? "" }}</td>
    <td>{{ $item->begindate ?? "" }}</td>
    <td>{{ $item->enddate ?? "" }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
</section>
@endsection
