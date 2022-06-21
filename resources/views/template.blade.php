<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <title>Document</title>
</head>
<body class="mybodymain">
<div class="main">
    <div class="main_top2">
       <div class="main_top-title2">
        <p class="main_title">Автоматизированная информационная система "Руководитель организации здравоохранения"</p>
        </div>
    </div>
    <div class="wrapper_inner">
        <div class="sidebar-left2">
            <div class="template_main">
            <div class="sidebar_top23">
                <div class="bar">
                    <button class="button_1  btn_sidebar  btn_icon btn_sidebar-15 organization btn_sidebar-panel" data-url="{{ route('mainlist') }}">
                    Перечень организаций здравоохранения Кыргызской Республики

                    </button>
                    <div class="btn_sidebar-content">                
                      <button class="button_1 btn_sidebar2" data-url="{{ route('republic') }}" name="but2">Республиканского значения</button>
                      <button id="bishkek" class="button_1 btn_sidebar2" data-url="{{ route('bishkek') }}" name="but2">г. Бишкек</button>
                      <button class="button_1 btn_sidebar2" data-url="{{ route('osh') }}" name="but3">г. Ош</button>
                       <button id="batken" class="button_1 btn_sidebar2" data-url="{{ route('batkenoblast') }}" name="but1">Баткенская область</button>
                        <button class="button_1 btn_sidebar2" data-url="{{ route('djalaloblast') }}" name="but1">Джалал-Абадская область</button>
                        <button class="button_1 btn_sidebar2" data-url="{{ route('oshoblast') }}" name="but1">Ошская область</button>
                        <button class="button_1 btn_sidebar2" data-url="{{ route('talasoblast') }}" name="but1">Таласская область</button>
                        <button class="button_1 btn_sidebar2" data-url="{{ route('narynoblast') }}" name="but1">Нарынская область</button>
                        <button class="button_1 btn_sidebar2" data-url="{{ route('issykoblast') }}" name="but1">Иссык-Кульская область</button>
                        <button class="button_1 btn_sidebar2" data-url="{{ route('chuioblast') }}" name="but1">Чуйская область</button>    
                    </div>
                    </div>
                
                 </div>
                 <button class="button_2  btn_sidebar  btn_icon btn_sidebar-16 application btn_sidebar-panel2" data-url="{{ route('mainlist2') }}" name="but1">Резерв кадров руководителей организаций здравоохранения</button>  
                 <div class="btn_sidebar-content2">
                    <?php $i = 1; ?>                    
                       <button id="bishkek" class="button_2 btn_sidebar2" data-url="{{ route('bishkek2') }}" name="but2">г. Бишкек</button>
                      <button class="button_2 btn_sidebar2" data-url="{{ route('osh2') }}" name="but3">г. Ош</button>
                       <button id="batken" class="button_2 btn_sidebar2" data-url="{{ route('batkenoblast2') }}" name="but1">Баткенская область</button>
                        <button class="button_2 btn_sidebar2" data-url="{{ route('djalaloblast2') }}" name="but1">Джалал-Абадская область</button>
                        <button class="button_2 btn_sidebar2" data-url="{{ route('oshoblast2') }}" name="but1">Ошская область</button>
                        <button class="button_2 btn_sidebar2" data-url="{{ route('talasoblast2') }}" name="but1">Таласская область</button>
                        <button class="button_2 btn_sidebar2" data-url="{{ route('narynoblast2') }}" name="but1">Нарынская область</button>
                        <button class="button_2 btn_sidebar2" data-url="{{ route('issykoblast2') }}" name="but1">Иссык-Кульская область</button>
                        <button class="button_2 btn_sidebar2" data-url="{{ route('chuioblast2') }}" name="but1">Чуйская область</button>    
                    </div>
                 <button class="button_5 btn_sidebar  btn_icon btn_sidebar-17 registration" data-url="{{ route('registerajax') }}" name="but1">Пройти регистрацию</button>  
            </div>
             <div class="sidebar_bottom">
                <a href="{{ route('auth.get.login') }}" class="sidebar_btn">Войти</a>
            </div>  
            </div>
            <div class="sidebar_bg">                
            </div>
        </div>
        <div class="content-right">
           @yield('content')
        </div>
    </div>
    
</div>
<script>
    $(document).ready(function(){   
        let id= document.getElementById('customers30').innerHTML;
        console.log(id);
        if('mainlist' == id ) {
            $('#main').attr('style', 'display:block');
            $('#post_id').attr('style', 'display:none');
            $('#head_number').attr('style', 'display:none');
         } else if('staff'==id) {
            $('#staff').attr('style', 'display:block');
            $('.btn_sidebar-panel').attr('style', 'pointer-events:auto'); 
            $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto'); 
            $('#post_id').attr('style', 'display:none');
            $('#head_number').attr('style', 'display:none');
        } else if('register'==id) {
            $('.main_list-item').attr('style', 'display:none');
            $('.btn_sidebar-panel').attr('style', 'pointer-events:auto'); 
            $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto'); 
            $('#post_id').attr('style', 'display:none');
            $('#head_number').attr('style', 'display:none');
        }else {
            $('.main_list-item').attr('style', 'display:none');
            $('.btn_sidebar-panel').attr('style', 'pointer-events:none'); 
            $('.btn_sidebar-panel2').attr('style', 'pointer-events:none'); 
            $('#post_id').attr('style', 'display:none');
        }
        
        if('main'==id){
             $('#post_id').attr('style', 'display:none');
             $('#head_number').attr('style', 'display:none');
        }
        

        
        $(".button_1").click(function(e) {
            var $li = $(this);
            e.preventDefault();
            let url = $(this).attr('data-url');           
            $('.btn_sidebar-panel2').removeClass('active');
            $( ".btn_sidebar-panel2" ).attr('style', 'pointer-events:auto');
            $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                success: function(data){
                         let items = $('#items').val(data.items);
                         if(items == 'main') {
                            $('#staff2').attr('style', 'display:none');
                         }
                         $('.button_2').parent().find('.btn_sidebar-content2').slideUp();
                         $( ".btn_sidebar-panel" ).attr('style', 'pointer-events:none');
                         $("#customers").html(data.table_data);
                         $("#head_top-title").html(data.batken);
                         
                         $('#customers30').text(data.items);
                         $('#head_number').text(data.count);
                         $('html, body').animate({ scrollTop: 0 }, 0);
                         const nextTitle = 'My new page title';
                         window.history.pushState('Strubg', 'Title', url);
                         let id= document.getElementById('customers30').innerHTML;
                         console.log(id);
                        if('mainlist' == id ) {
                            $('#main').attr('style', 'display:none')
                            $('.btn_sidebar-panel').attr('style', 'pointer-events:none');
                            $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto');
                            $('#post_id').attr('style', 'display:flex');
                        } else if('register'==id) {
                            $('.main_list-item').attr('style', 'display:none')
                            $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto'); 
                            $('.btn_sidebar-panel').attr('style', 'pointer-events:auto'); 
                            $('.button_1.registration').attr('style', 'pointer-events:none');
                            $('#post_id').attr('style', 'display:none');
                        } else if('main'==id) {
                            $('#staff').attr('style', 'display:none');
                            $('#main').attr('style', 'display:block');
                            $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto'); 
                            $('.btn_sidebar-panel').attr('style', 'pointer-events:auto'); 
                            $('.button_1.registration').attr('style', 'pointer-events:none');
                            $('#post_id').attr('style', 'display:none');
                        } else {
                            $('#main').attr('style', 'display:block');
                            $('.button_1.registration').attr('style', 'pointer-events:auto');
                            $('#post_id').attr('style', 'display:none');
                        }

                        $('.button_1.active').removeClass('active');
                        $('.button_2.active').removeClass('active');
                        $('.button_5.active').removeClass('active');
                        $li.addClass('active');
 
                         
                     }

            });
        });
        
        $(".button_5").click(function(e) {
            var $li = $(this);
            e.preventDefault();
            let url = $(this).attr('data-url');
            $('.btn_sidebar-panel2').removeClass('active');
            $( ".btn_sidebar-panel2" ).attr('style', 'pointer-events:auto');
            $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                success: function(data){
                         $('.button_2').parent().find('.btn_sidebar-content2').slideUp();
                         $('.button_1').parent().find('.btn_sidebar-content').slideUp();
                         $( ".btn_sidebar-panel" ).attr('style', 'pointer-events:none');
                         $("#customers").html(data.table_data);
                         $("#head_top-title").html(data.batken);
                         $('#customers30').text(data.items);
                         $('#head_number').text(data.count);
                         window.history.pushState('Strubg', 'Title', url);
                         let id= document.getElementById('customers30').innerHTML;
                         console.log(id);
                         if('mainlist' == id ) {
                            $('.main_list-item').attr('style', 'display:none')
                            $('.btn_sidebar-panel').attr('style', 'pointer-events:none');
                            $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto'); 
                        } else if('register'==id) {
                            $('.main_list-item').attr('style', 'display:none')
                            $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto'); 
                            $('.btn_sidebar-panel').attr('style', 'pointer-events:auto'); 
                            $('.button_1.registration').attr('style', 'pointer-events:none');
                        } else {
                            $('.main_list-item').attr('style', 'display:block');
                            $('.button_1.registration').attr('style', 'pointer-events:auto');
                        }
                        if(1==data.post_id){
                            $('#post_id').hide();
                            $('.button_1.active').removeClass('active');
                            $('.button_2.active').removeClass('active');
                            $li.addClass('active');
                         } else {
                            $('#post_id').show();
                            $('.button_1.active').removeClass('active');
                            $('.button_2.active').removeClass('active');
                            $li.addClass('active');
                         }
                         
                     }

            });
        });
        
       $(".button_2").click(function(e) {
            $('.button_1').parent().find('.btn_sidebar-content').slideUp();
            $('.btn_sidebar-panel').removeClass('active');
            $( ".btn_sidebar-panel2" ).attr('style', 'pointer-events:none'); 
            $( ".btn_sidebar-panel" ).attr('style', 'pointer-events:auto');  
            var $li = $(this);
            e.preventDefault();
            let url = $(this).attr('data-url');            
            $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                success: function(data){ 
                         let items = $('#items').val(data.items);   
                         if(items == 'staff2') {
                            $('#main').attr('style', 'display:none');
                         }                
                         $("#customers").html(data.table_data);
                         $("#head_top-title").html(data.batken);
                         $('.contentbar').attr('style', 'display:none');
                         $('#customers30').text(data.items);
                         
                         $('#head_number').text(data.count);
                         window.history.pushState('Strubg', 'Title', url);
                         let id= document.getElementById('customers30').innerHTML;
                         console.log(id);
                         if('mainlist' == id ) {
                            $('#staff').attr('style', 'display:none');
                            $('#post_id').attr('style', 'display:flex');
                        } else {
                            $('#staff').attr('style', 'display:block');
                            $('#main').attr('style', 'display:none');
                            $('#post_id').attr('style', 'display:none');
                        }

                        $('.button_1.active').removeClass('active');
                        $('.button_2.active').removeClass('active');
                        $('.button_5.active').removeClass('active');
                        $li.addClass('active');

                         
                     }

            });
        });
        
      $(".button_3").click(function(e) {
          $('#post_id').attr('style', 'display:none');
            var $li = $(this);
            let url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                success: function(data){
                         $('.button_1').parent().find('.btn_sidebar-content').slideToggle();           
                         $("#customers").html(data.table_data);
                         $("#head_top-title").html(data.batken);
                         $('#customers30').text(data.items);
                         $('#head_number').text(data.count);
                         window.history.pushState('Strubg', 'Title', url);
                         let id= document.getElementById('customers30').innerHTML;
                         console.log(id);
                         if('mainlist' == id ) {
                            $('.main_list-item').attr('style', 'display:none');
                            $('.btn_sidebar-panel2').attr('style', 'pointer-events:auto'); 
                            $('.btn_sidebar-panel').attr('style', 'pointer-events:none');
                            $('#post_id').attr('style', 'display:flex');
                        } else {
                            $('.main_list-item').attr('style', 'display:block');
                            $('#post_id').attr('style', 'display:none');
                        }
                         console.log(data);
                        $('.button_2.active').removeClass('active');
                        $('.button_5.active').removeClass('active');
                        $('.btn_sidebar-panel').addClass('active');

                         
                     }

            });
        });

        $(".button_4").click(function(e) {
            var $li = $(this);
            let url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method:"GET",
                dataType:'json',
                success: function(data){
                         $('.button_2').parent().find('.btn_sidebar-content2').slideToggle();           
                         $("#customers").html(data.table_data);
                         $("#head_top-title").html(data.batken);
                         $('#customers30').text(data.items);
                         $('#head_number').text(data.count);
                         window.history.pushState('Strubg', 'Title', url);
                         let id= document.getElementById('customers30').innerHTML;
                         console.log(id);
                         if('mainlist' == id ) {
                            $('.main_list-item').attr('style', 'display:none');
                            $('.btn_sidebar-panel2').attr('style', 'pointer-events:none'); 
                            $('.btn_sidebar-panel').attr('style', 'pointer-events:auto'); 
                            $('#post_id').attr('style', 'display:flex');
                        } else {
                            $('.main_list-item').attr('style', 'display:block'); 
                            $('#post_id').attr('style', 'display:none');
                        }                     
                         console.log(data);
                        $('.button_1.active').removeClass('active');
                        $('.button_5.active').removeClass('active');
                        $('.btn_sidebar-panel2').addClass('active');

                     }

            });
        });

        $("#formregister").submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: url, 
                data: formData,
                cache:false,
                dataType:'json',
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $("#formregister").find('span.error-text').text('');
                },
                success:function (response) {
                if(response.code != 200){
                    console.log(response);
                    let errors =response.msg;
                    $.each(errors, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.code == 200){
                    let success = '<span class="modal_alert">'+'<p>'+response.msg+'</p>'+'<a class="btn btn-primary" href="/login">'+'Войти'+'</a>'+ '</span>';
                    console.log(response.msg);
                    $("#res").html(success);
                }
            }
            });   
            
        });

    });
</script> 
<script type="text/javascript" src="{{ asset('assets/js/libs.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>