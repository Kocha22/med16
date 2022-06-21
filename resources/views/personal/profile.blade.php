@extends('templateinner2')

@section('content')
<div class="personal_inner">
    <div class="personal">
    </div>
    <p class="personal_title">Личные данные</p>
</div>
 <form id="frm" action="" method="post">
    <input type="hidden" id="token" value="{{ @csrf_token() }}">
      <section class="news">
       <div class="container">
                <form id="frm" action="" method="post">
     
                    <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="name">Номер заявки</label></td>
                            <td><div id="name">{{ $post->applicant_code ?? "" }}</div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="name">ФИО заявителя</label></td>
                            <td><div id="name">{{ $post->surname ?? "" }} {{ $post->name ?? "" }} {{ $post->middle ?? "" }}</div>
                             </td>
                        </tr>
                        <tr>
                            <td><label for="dateofbirth">Дата рождения</label></td>
                            <td>{{ $post->dateofbirth ?? "" }}
                             </td>
                        </tr>
                        <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->age ?? "" }}
                             </td>
                        </tr> 
                         <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->area_id ?? "" }}
                             </td>
                        </tr> 
                        <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->address ?? "" }}
                             </td>
                        </tr> 
                        <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->actual_address ?? "" }}
                             </td>
                        </tr> 
                        <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->residential_address ?? "" }}
                             </td>
                        </tr> 
                        <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->passport ?? "" }}
                             </td>
                        </tr>
                        <tr>
                            <td><label for="phone">Адрес проживания</label></td>
                            <td>{{ $post->phone ?? "" }}
                             </td>
                        </tr>  
                        <tr>
                            <td><label for="email">Адрес электронной почты</label></td>
                            <td>{{ $post->email ?? "" }}
                             </td>
                        </tr>
                                                       
                    </tbody>
                </table>

                <div id="res" ></div>
               
                </form>

       <div>
</section>

@endsection