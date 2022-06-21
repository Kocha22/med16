@extends('template')

@section('content')
<div class="head_top-outer">
<div class="head_inner">
    <div id="head_top-title">
    <h4  class="head_title">
</h4>
    </div>
    <div id="head_number" class="head_number2"></div>
 </div>
 <div ></div>


<div class="form-gr" id="post_id">

      <input type="text" id="searchstaff" name="search" class="form-control"  placeholder="Поиск..." />
            <div class="button-submit">                
				<input id="btn" class="button light-blue" type="submit" value="Поиск">                
                </div>

</div>
</div>
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
<div id="customers30" style="display:none;">{{ $items }}</div>
    <div id='customers33' class="main_list">

<div class="main_list-item" id="main" style="display:none;">
<h4 class="main_list-title">Перечень организаций здравоохранения Кыргызской Республики
по административно-территориальным единицам
</h4>
<div id="contentbar" class="btn_sidebar-content22">                
                      <button class="button_3 btn_sidebar3" data-url="{{ route('republic') }}" name="but2">Республиканского значения<span  class='number_org'>25</span></button>
                      <button id="bishkek" class="button_3 btn_sidebar3" data-url="{{ route('bishkek') }}" name="but2">г.Бишкек<span  class='number_org'>25</span></button>
                      <button class="button_3 btn_sidebar3" data-url="{{ route('osh') }}" name="but3">г.Ош<span  class='number_org'>24</span></button>
                       <button id="batken" class="button_3 btn_sidebar3" data-url="{{ route('batkenoblast') }}" name="but1">Баткенская область<span  class='number_org'>24</span></button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('djalaloblast') }}" name="but1">Джалал-Абадская область<span  class='number_org'>25</span></button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('oshoblast') }}" name="but1">Ошская область<span  class='number_org'>25</span></button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('talasoblast') }}" name="but1">Таласская область<span  class='number_org'>19</span></button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('narynoblast') }}" name="but1">Нарынская область<span  class='number_org'>23</span></button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('issykoblast') }}" name="but1">Иссык-Кульская область<span  class='number_org'>25</span></button>
                        <button class="button_3 btn_sidebar3" data-url="{{ route('chuioblast') }}" name="but1">Чуйская область<span  class='number_org'>25</span></button>    
</div>
<div class="button-submit">                
				<a href="{{ route('mainlogin') }}" id="btn" class="button light-blue">На главную</a>
</div>
</div>

<div class="main_list-item" id="staff"  style="display:none;">
<h4 class="main_list-title">Резерв кадров руководителей организаций здравоохранения
по административно-территориальным единицам
</h4>
<div id="contentbar" class="btn_sidebar-content22">                
                        <button id="bishkek" class="button_4 btn_sidebar3" data-url="{{ route('bishkek2') }}" name="but2">г.Бишкек<span class='number_org'>6</span></button>
                      <button class="button_4 btn_sidebar3" data-url="{{ route('osh2') }}" name="but3">г.Ош<span class='number_org'>9</span></button>
                       <button id="batken" class="button_4 btn_sidebar3" data-url="{{ route('batkenoblast2') }}" name="but1">Баткенская область<span class='number_org'>2</span></button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('djalaloblast2') }}" name="but1">Джалал-Абадская область<span class='number_org'>0</span></button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('oshoblast2') }}" name="but1">Ошская область<span class='number_org'>19</span></button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('talasoblast2') }}" name="but1">Таласская область<span class='number_org'>12</span></button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('narynoblast2') }}" name="but1">Нарынская область<span class='number_org'>0</span></button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('issykoblast2') }}" name="but1">Иссык-Кульская область<span class='number_org'>2</span></button>
                        <button class="button_4 btn_sidebar3" data-url="{{ route('chuioblast2') }}" name="but1">Чуйская область<span class='number_org'>2</span></button>    
</div>
<div class="button-submit">                
				<a href="{{ route('mainlogin') }}" id="btn" class="button light-blue">На главную</a>
</div>
</div>


</div>
@endsection