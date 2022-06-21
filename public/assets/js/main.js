$(document).ready(function(){ 
      $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        yearRange: '1940:1997',
        changeMonth: true,
        changeYear: true,
        minDate: new Date(1940, 10 - 1, 25),
        maxDate: '+57Y',
        defaultDate: '-81y',
        onSelect:function(date){            
            var today=new Date();                
            var result=DateDiff(today,new Date(date));            
            $('#result').val(result);          
            
        }        
    },
    $.datepicker.regional['ru']);

    $(".terdatepicker, .startdatepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        yearRange: '1940:2022',
        changeMonth: true,
        changeYear: true,
        minDate: new Date(1940, 10 - 1, 25),
        maxDate: '+57Y',
    },
    $.datepicker.regional['ru']);

    jQuery(function ($) {
        $.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: '&#x3c;Пред',
            nextText: 'След&#x3e;',
            currentText: 'Сегодня',
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthNamesShort: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
            dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            weekHeader: 'Нед',
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ru']);
    });

    function DateDiff(date1,date2) {
        var diff=date1 - date2;
        var num_years = diff/31536000000;
      
            return Math.floor(num_years);
    }

    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });


    $('.btn_sidebar-content').hide();
    $('.btn_sidebar-content2').hide();
    
    $('.ul_panelmenu').on('click', function(){
      $(this).parent().find('.ul-icon').toggleClass("active");
      $(this).parent().find('.panelmenu_content').slideToggle();
    });
    
    $('.arrow_down').on('click', function() {
        $('.login_name2').toggle();
    })
    

});