@extends('templateinner')

@section('content')
@if($sign == 1)
<div class="form_applicant">
<div class="personal_inner">     
    <p class="personal_title">Уведомление
</div>
 <form id="frm" action="" method="post">
    <input type="hidden" id="token" value="{{ @csrf_token() }}">
    <input type="hidden" id="user_id" value="{{ $user_id ?? '' }}">
    <input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
      <section class="news">
       <div class="container">
                <form id="frm" action="" method="post">                    
                    <div class="form-table">
                    <div class="note__inner">
                        <div class="note_item">
                            <div class="note_left">Номер уведомления</div>
                            <div class="note_right">{{ $post->id ?? '' }}
                             </div>
                        </div>
                        <div class="note_item">
                            <div class="note_left">Раздел</div>
                            <div class="note_right">
                                Вакансия
                             </div>
                        </div>
                        <div class="note_item">
                            <div class="note_left">Текст уведомления</div>
                            <div class="note_right message">
                            Объявляется конкурс на замещение должности {{ $post->positions->name ?? "" }}, {{ $post->departments->name ?? "" }}, для участия просим до {{ $post->date_app ?? "" }} подать...
                             </div>
                        </div>    
                        <div class="note_item">
                            <div></div>
                            <div>

                              @if($hasTalk)
                              <div class="button-submit"> 
                                <button class="button_10 btn btn-info" data-url="{{ route('notesaction', ['user_id'=> $user_id, 'post_id' => $post->id]) }}" name="but1" disabled>Заявка подана на конкурс</button>
                             </div>
                              @else
                              <div class="button-submit"> 
                                <button id="btn_contest" class="button_10 btn btn-info" data-url="{{ route('notesaction', ['user_id'=> $user_id, 'post_id' => $post->id]) }}" name="but1">Подать заявку на конкурс</button>
                             </div>
                              @endif

                             </div>
                        </div>                 
                                                         
                    </tbody>
                </table>
                <div id="res" ></div>
               
                </form>
     
       <div>
    </section>
    </div>
@elseif($sign == 3)
<div class="form_applicant">
<div class="personal_inner">     
    <p class="personal_title">Уведомление
</div>
 <form id="frm" action="" method="post">
    <input type="hidden" id="token" value="{{ @csrf_token() }}">
    <input type="hidden" id="user_id" value="{{ $user_id ?? '' }}">
    <input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
      <section class="news">
       <div class="container">
                <form id="frm" action="" method="post">                    
                    <div class="form-table">
                    <div class="note__inner">
                        <div class="note_item">
                            <div class="note_left">Номер уведомления</div>
                            <div class="note_right">{{ $post->id ?? '' }}
                             </div>
                        </div>
                        <div class="note_item">
                            <div class="note_left">Раздел</div>
                            <div class="note_right">
                                {{ $post->department_id ?? '' }} {{ $post->title ?? '' }}
                             </div>
                        </div>
                        <div class="note_item">
                            <div class="note_left">Текст уведомления</div>
                            <div class="note_right message">
                                {{ $post->message ?? '' }} {{ $post->description ?? '' }}
                             </div>
                        </div>    
                        <div class="note_item">
                            <div></div>
                            <div>
                            @if($post2->restatus_id == 5 || $post2->restatus_id == 4)
                              <div class="button-submit"> 
                              <button class="button_10 btn btn-info" data-url="{{ route('attestate', ['user_id'=> $user_id]) }}" name="but1" disabled>Аттестация</button>
                                <button class="button_10 btn btn-info" data-url="{{ route('retraining', ['user_id'=> $user_id]) }}" name="but1" disabled>Обучение</button> 
                              </div>
                            @else
                            <div class="button-submit"> 
                            <button class="button_10 btn btn-info" data-url="{{ route('attestate', ['user_id'=> $user_id]) }}" name="but1">Аттестация</button>
                                <button class="button_10 btn btn-info" data-url="{{ route('retraining', ['user_id'=> $user_id]) }}" name="but1">Обучение</button> 
                              </div>
                            @endif
                         
                             </div>
                        </div>                 
                                                         
                    </tbody>
                </table>
                <div id="res" ></div>
               
                </form>
     
       <div>
    </section>
    </div>
@else
<div class="form_applicant">
<div class="personal_inner">     
    <p class="personal_title">Уведомление
</div>
 <form id="frm" action="" method="post">
    <input type="hidden" id="token" value="{{ @csrf_token() }}">
    <input type="hidden" id="user_id" value="{{ $user_id ?? '' }}">
    <input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
      <section class="news">
       <div class="container">
                <form id="frm" action="" method="post">                    
                    <div class="form-table">
                    <div class="note__inner">
                        <div class="note_item">
                            <div class="note_left">Номер уведомления</div>
                            <div class="note_right">{{ $post->id ?? '' }}
                             </div>
                        </div>
                        <div class="note_item">
                            <div class="note_left">Раздел</div>
                            <div class="note_right">
                                {{ $post->department_id ?? '' }} {{ $post->title ?? '' }}
                             </div>
                        </div>
                        <div class="note_item">
                            <div class="note_left">Текст уведомления</div>
                            <div class="note_right message">
                                {{ $post->message ?? '' }} {{ $post->description ?? '' }}
                             </div>
                        </div>    
                        <div class="note_item">
                            <div></div>
                            <div>
                             @if($post->id  == 1)
                            <div class="button-submit"> 
                                <button class="button_10 btn btn-info" data-url="#" name="but1">Аттестация</button>
                                <button class="button_10 btn btn-info" data-url="#" name="but1">Обучение</button> 
                              </div>
                            @elseif($post->status == 2)
                            <div class="button-submit"> 
                                <button class="button_10 btn btn-info" data-url="{{ route('sayYes', ['user_id'=> $user_id, 'post_id' => $post->id]) }}" name="but1">Да</button>
                                <button class="button_10 btn btn-info" data-url="{{ route('sayNo', ['user_id'=> $user_id, 'post_id' => $post->id]) }}" name="but1">Нет</button>
                              </div>
                            @elseif($post->status == 4)
                            <div class="button-submit"> 
                                <button class="button_10 btn btn-info" data-url="{{ route('sayYes', ['user_id'=> $user_id, 'post_id' => $post->id]) }}" name="but1" disabled>Да</button>
                                <button class="button_10 btn btn-info" data-url="{{ route('sayNo', ['user_id'=> $user_id, 'post_id' => $post->id]) }}" name="but1" disabled>Нет</button>
                              </div>
                            @elseif($post->status == 3)
                            <div></div>
                            @else                                 
                              <div class="button-submit"> 
                                <button id="btn_contest" class="button_10 btn btn-info" data-url="{{ route('notesaction', ['user_id'=> $user_id, 'post_id' => $post->id]) }}" name="but1">Подать заявку на конкурс</button>
                             </div>
                            @endif
                             </div>
                        </div>                 
                                                         
                    </tbody>
                </table>
                <div id="res" ></div>
               
                </form>
     
       <div>
    </section>
    </div>
@endif


    <script>
       $(document).ready(function(){
       $(".button_10").click(function(e) {
            e.preventDefault();
            let user_id=$('#user_id').val();
            let url = $(this).attr('data-url');
             $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                success: function(response){
                    console.log(response.msg);
                    $(".button_10").prop('disabled', true);
                    $('#btn_contest').text('Заявка подана на конкурс');
                    }

            });
        });

        
            
        })
</script>
@endsection