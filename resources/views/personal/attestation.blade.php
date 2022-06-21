@extends('templateinner')

@section('content')
<div class="personal_inner">
    <div class="personal">
    </div>
    <p class="personal_title">Аттестация</p>
</div>
<section class="news">
       <div class="container">
                      <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="name">Дата прохождения</label></td>
                            <td><div id="name">                                
                                @if(!empty($valid->dateofentry))
                                    {{ $valid->dateofentry ?? "" }}
                                @endif                          
                            </div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="nameofdirector">Присвоенная квалификация</label></td>
                            <td>
                            @if(!empty($valid->qualifications->name))
                                    {{ $valid->qualifications->name ?? "" }}
                            @endif  
                             </td>                              
                        </tr>
                                                                             
                    </tbody>
                </table>
       <div>
</section>
<section class="news">
<div class="personal_inner">
    <div class="personal">
    </div>
    <p class="personal_title">Документы</p>
</div>
       <table id="customers">
       <thead>
  <tr>
    <th>Вид документа</th>
    <th>Наименование документа</th>
    <th>Прикрепленный файл</th>
    <th>Действие</th>
  </tr>
  </thead>
  <tbody>
  @foreach($data as $item)
  <tr>
    <td>{{ $item->typeofdocuments->name ?? "" }}</td>
    <td>{{ $item->nameofdocument ?? "" }}</td>    
    <td>{{ $item->file ?? "" }}</td>

  </tr>
  @endforeach
  </tbody>
</table>
</section>
@endsection
