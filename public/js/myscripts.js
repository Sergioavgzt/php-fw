$(document).ready(function(){
	
	/* открытие блока Помощь кликом */  
	$( "#opener" ).on( "click", function( event ) {
		$( "#dialog" ).slideDown( "slow", function() {});
	});
	
	/* закрытие блока Помощь кликом */  
	$( ".close" ).on( "click", function( event ) {
		$( "#dialog" ).slideUp( "slow", function() {});
	});

    /* Cкрипт для выпадающего списка при поиске */
    // Сюда указываем id поля поиска.
    $( "#search_box" ).bind('textchange', function () {
		
        // В переменную помещаем поисковое значение которое ввел пользователь.
        var input_search = $("#search_box").val();
        //alert (input_search);
        // Проверяем поисковое значение. Если оно больше или ровняется Трём, то всё нормально и также если меньше 150 символов.
        if (input_search.length >= 1 && input_search.length < 15 )
        {
            //$('#block-search-result').removeClass("hide");
            // Делаем запрос в обработчик в котором будет происходить поиск.
            $.ajax({
                type: "POST",
                url: "autocomplete", // Обработчик. название функции контроллера
                data: "q="+input_search, // В переменной <strong>q</strong> отправляем ключевое слово в обработчик.
                dataType: "html",
                cache: false,
                success: function(data) {

                    $("#block-search-result").show(); // Показываем блок с результатом.
                    $("#list-search-result").html(data); // Добавляем в список результат поиска.

                }
            });

        }

    });
	
    //Скрипт добавления селекторов классов соответствующим страницам
    $(".block_registration").parents(".public_page").addClass("page_registration");
    $(".block_authorization").parents(".public_page").addClass("page_authorization"); 
 
 
});





    //----------Скрипт адаптивного меню
    //Наиболее протестированный вариант в разных браузерах.
    jQuery(document).ready(function(){

        jQuery(".nav-collapse").prepend("<div class='menu-icon'><span class='mi_layer'></span><span class='icon-m icon1'></span><span class='icon-m icon2'></span><span class='icon-m icon3'></span></div>");
        jQuery(".nav-collapse").after("<div class='bg_menu'></div>");

        //Разворачивание меню при наведении на иконку мышью
        jQuery(".menu-icon").on("mouseenter touchstart", function (event) {
            jQuery("ul.nav-child").css("display", "none");
            jQuery(this).addClass("mi-active");
            jQuery(this).removeClass("menu-icon");
            setTimeout(function () {
                jQuery(".moduletable_menu").addClass("bmi-active bmi-width");
                jQuery(".bg_menu").addClass("bg_menu-active");
            }, 1);
            jQuery(".icon-m").addClass("active");
            jQuery("body").addClass("overflow");
            jQuery(document).bind("touchmove", false);
            return false;
        });

        function collapse_menu() {
            jQuery(".mi-active").addClass("menu-icon");
            jQuery(".mi-active").removeClass("mi-active");
            jQuery(".icon-m").removeClass("active");
            jQuery(".moduletable_menu").removeClass("bmi-active");
            jQuery(".bg_menu").removeClass("bg_menu-active");
            jQuery("body").removeClass("overflow");
            jQuery(document).unbind("touchmove", false);
            return false;
        }

        //Сворачивание меню при клике на фон и по закрывающей кнопке
        jQuery(".bg_menu, .mi_layer").on("click touchstart", collapse_menu);
        //Сворачивание меню при уводе мыши с области документа (браузера)
        jQuery("body").on("mouseleave", collapse_menu);


        //Убираем некоторые стили при растягивание браузера (при изменении разрешения)
        jQuery(window).resize(function(){
            var bmiWidth = jQuery(document).outerWidth(true);
            if (bmiWidth >=100) {//По сути значение равное любому маленькому числу, но можно указывать значение равное минимальному разрешению экрана либо же максимальному max-width в файле адаптации стилей минус (-) ширина вертикальной полосы прокрутки (в стандартном исполнении = 18px). 
                jQuery(".mi-active").addClass("menu-icon");
                jQuery(".mi-active").removeClass("mi-active");
                jQuery(".icon-m").removeClass("active");
                jQuery(".moduletable_menu").removeClass("bmi-active bmi-width");
                jQuery(".bg_menu").removeClass("bg_menu-active");
                jQuery("body").removeClass("overflow");
                jQuery(document).unbind("touchmove", false);
                jQuery("ul.nav-child").css("display", "block");
            }
        });

        //Аккордеон
        jQuery(".parent a").click(function(){
            jQuery(".parent .nav-child").slideUp(500);
            if(jQuery(this).parent(".parent").find(".nav-child").is(":visible")) {
                jQuery(this).parent(".parent").find(".nav-child").slideUp(500);
            }
            else {
                jQuery(this).parent(".parent").find(".nav-child").slideDown(500);
            }
        });


    });
    //---------- Конец скрипта адаптивного меню






/* function checkMe() {
    if (confirm("Are you sure")) {
        alert("Clicked Ok");
        return true;
    } else {
        alert("Clicked Cancel");
        return false;
    }
} */

	
	/* 	$( ".btn_delete" ).on( "click", function( event ) {

		function confirmDelete() {
			if (confirm("Вы подтверждаете удаление?")) {
				return true;
			} else {
				return false;
			}
		}
	});
    */	


