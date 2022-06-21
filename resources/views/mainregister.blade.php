@extends('template')

@section('content')
<div class="head_inner">
    <div id="head_top-title" class="head_top-line">
    <h4  class="head_title">
</h4>
    </div>
 </div>
 <div ></div>

<form id="formregister" action="{{ route('postregister') }}" method="post">



<div class="form-home222">
    

<table id="customers">                
                    
                        
    </tbody>
    </table> 
    <span class="page_links"></span>
    </div>
<div id="res" ></div>

</div>

</div>
    </div>
</div>
<div id="customers30"></div>

<div id="res" ></div>

</div>

</div>
    </div>
</div>
    <div id='customers33' class="main_list">
@if('mainlist' == true)
<div class="main_list-item">
<h4 class="main_list-title">Перечень организаций здравоохранения Кыргызской Республики
по административно-территориальным единицам
</h4>
<div id="contentbar" class="btn_sidebar-content22">                
                      <button class="button_3 btn_sidebar3" data-url="{{ route('republic') }}" name="but2">Республиканского значения</button>
                      <button id="bishkek" class="button_3 btn_sidebar3" data-url="{{ route('bishkek') }}" name="but2">г.Бишкек</button>
                      <button class="button_3 btn_sidebar3" data-url="{{ route('osh') }}" name="but3">г.Ош</button>
                       <button id="batken" class="button_3 btn_sidebar3" data-url="{{ route('batkenoblast') }}" name="but1">Баткенская область</button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('djalaloblast') }}" name="but1">Джалал-Абадская область</button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('oshoblast') }}" name="but1">Ошская область</button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('talasoblast') }}" name="but1">Таласская область</button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('narynoblast') }}" name="but1">Нарынская область</button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('issykoblast') }}" name="but1">Иссык-Кульская область</button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('chuioblast') }}" name="but1">Чуйская область</button>    
</div>
</div>
@elseif('mainlist' == false)
<div class="main_list-item">
<h4 class="main_list-title">Резерв кадров руководителей организаций здравоохранения
по административно-территориальным единицам
</h4>
<div id="contentbar" class="btn_sidebar-content22">                
                        <button id="bishkek" class="button_4 btn_sidebar3" data-url="{{ route('bishkek2') }}" name="but2">г.Бишкек</button>
                      <button class="button_4 btn_sidebar3" data-url="{{ route('osh') }}" name="but3">г.Ош</button>
                       <button id="batken" class="button_4 btn_sidebar3" data-url="{{ route('batkenoblast2') }}" name="but1">Баткенская область</button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('djalaloblast2') }}" name="but1">Джалал-Абадская область</button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('oshoblast2') }}" name="but1">Ошская область</button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('talasoblast2') }}" name="but1">Таласская область</button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('narynoblast2') }}" name="but1">Нарынская область</button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('issykoblast2') }}" name="but1">Иссык-Кульская область</button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('chuioblast2') }}" name="but1">Чуйская область</button>    
</div>
</div>
@else
<div></div>
@endif
</div>
<script>    
    $(document).ready(function(){
            $('#post_id').hide();
            function showdata() {
            $.ajax({
                    url:"{{ route('registerajax') }}",
                    method:'GET', 
                    dataType:'json',
                    success: function(data){
                         $('.button_1.registration').addClass('active');
                         $("#head_top-title").html(data.batken);
                         $("#customers").html(data.table_data);  
                         $('#customers30').text(data.items);
                         let id= document.getElementById('customers30').innerHTML;
                            console.log(id);
                            if('mainlist' == id ) {
                                $('.main_list-item').attr('style', 'display:none')
                            } else if('register'==id) {
                                $('.main_list-item').attr('style', 'display:none')
                                $('.btn_sidebar-panel').attr('style', 'pointer-events:auto'); 
                                $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto');  
                            }else {
                                $('.main_list-item').attr('style', 'display:block')
                                $('.btn_sidebar-panel').attr('style', 'pointer-events:none'); 
                                $('.btn_sidebar-panel2').attr('style', 'pointer-events:none');  
                            }
                    }
                });
        }
        showdata();
    });
</script>
@endsection