;( function( $, window, undefined ) {




    'use strict';

    // use polyfill if needed for observer


    if (!('IntersectionObserver' in window)) {
        var script = document.createElement("script");
        script.src = "https://raw.githubusercontent.com/w3c/IntersectionObserver/master/polyfill/intersection-observer.js";
        document.getElementsByTagName('head')[0].appendChild(script);
    }

    if (!('IntersectionObserver' in window)) {
        var script = document.createElement("script");
        script.src = "//cdn.jsdelivr.net/npm/mutationobserver-shim/dist/mutationobserver.min.js";
        document.getElementsByTagName('head')[0].appendChild(script);
    }

    // add webfonts



    // only if IE9/10

    var script = document.createElement("script");
    script.src = "https://polyfill.io/v3/polyfill.min.js?features=default%2CElement.prototype.classList%2CElement.prototype.remove";
    document.getElementsByTagName('head')[0].appendChild(script);




    function IE(v) {
        return RegExp('msie' + (!isNaN(v)?('\\s'+v):''), 'i').test(navigator.userAgent);
    }

    if(IE(10)){

    }

    // for testing ie //


    var doc = document.documentElement;
    doc.setAttribute('data-ie10', IE(10));
    doc.setAttribute('data-ie11', IE(11));
    doc.setAttribute('data-useragent', navigator.userAgent)


    /* --------------------------------------------------- */
    /* Preloader
    ------------------------------------------------------ */
    $(window).load(function() {




        // will first fade out the loading animation

    });

    $(window).load(function(){

        /* sticky menu */

        // When the user scrolls the page, execute sticky
        window.onscroll = function() {makeHeaderStick()};

        // Get the header
        var header = document.getElementById("masthead");

        // Get the offset position of the navbar
        var sticky = header.offsetTop;

        // logo
        var logo = $("#logo");

        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position

        function makeHeaderStick() {
            //var scroll = ;

            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");

            } else {
                header.classList.remove("sticky");

            }
            switchLogo();
        }

        function switchLogo(){

            // sticky menu logo change. Check logo handler function in filters.php

            if(header.classList.contains('sticky')){
                var stickyLogo = logo.data('sticky');
                logo.attr('src', stickyLogo);
            } else {
                var originalLogo = logo.data('original');
                logo.attr('src', originalLogo);
            }
        }

        /* start animating on scroll */

        AOS.init(
            AOS.init({throttleDelay: 10})
        );
        AOS.refreshHard()

        window.addEventListener('load', function() {
            AOS.refresh();
            AOS.refreshHard();
        });
    });

    $(document).ready(function($) {


        (function(){
            var burger = document.querySelector('.burger-container'),
                header = document.querySelector('.category__navigation');

            if(burger) {
                burger.onclick = function () {
                    header.classList.toggle('menu-opened');
                }
            }
        }());

        var toggles = document.querySelectorAll(".cmn-toggle-switch");
        var overlay = document.getElementById('menu-overlay');
        var sitewrap = document.getElementById('sitewrap');



        for (var i = toggles.length - 1; i >= 0; i--) {
            var toggle = toggles[i];
            toggleHandler(toggle);
        }

        // open burger menu

        function toggleHandler(toggle) {
            toggle.addEventListener( "click", function(e) {
                e.preventDefault();
                (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
                (overlay.classList.contains("active") === true) ? overlay.classList.remove("active") : overlay.classList.add("active");
                (sitewrap.classList.contains("active") === true) ? sitewrap.classList.remove("active") : sitewrap.classList.add("active");

                var navbarMenu = document.getElementById('navbarBurger')
                if(navbarMenu.classList.contains("is-active") === true){
                    navbarMenu.classList.add("is-out");
                    setTimeout(function(){
                        navbarMenu.classList.remove("is-active");
                    }, 300)


                    } else {
                            navbarMenu.classList.remove("is-out");
                            navbarMenu.classList.add("is-active")
                    };
            });
        }

        // Rea More

        var readMoreToggles = document.querySelectorAll(".toggle__more");

        for (var i = readMoreToggles.length - 1; i >= 0; i--) {
            var toggle = readMoreToggles[i];
            readMoreToggle(toggle);
        }

        // open submenu

        var subItem = document.querySelectorAll(".arrow-down, .has-children");

        for (var i = subItem.length - 1; i >= 0; i--) {
            var toggle = subItem[i];
            //subMenuToggleHandler(toggle);
        }


        var submenuOpen = document.querySelectorAll(".sub-menu");


        for (var i = submenuOpen.length - 1; i >= 0; i--) {
            var subm = submenuOpen[i];
            //closeSubmenuWithHover(subm)
        };



        // open burger menu

        function subMenuToggleHandler(toggle) {
            toggle.addEventListener( "click", function(e) {
                e.preventDefault();
                openSubmenu(this);
            });
            // toggle.addEventListener( "mouseover", function(e) {
            //     e.preventDefault();
            //     openSubmenuWithHover(this);
            // });






        }

        function openSubmenu(obj){
            (obj.parentNode.getElementsByClassName('sub-menu')[0].classList.contains("open") === true) ? obj.parentNode.getElementsByClassName('sub-menu')[0].classList.remove("open") : obj.parentNode.getElementsByClassName('sub-menu')[0].classList.add("open");
            (obj.classList.contains("open") === true) ? obj.classList.remove("open") : obj.classList.add("open");
        }

        function closeSubmenuWithHover(obj){

            obj.addEventListener( "mouseout", function(e) {

                console.log('mouseout');
                obj.parentNode.getElementsByClassName('sub-menu')[0].classList.remove("open");
            });

        }

        function openSubmenuWithHover(obj){

            obj.parentNode.getElementsByClassName('sub-menu')[0].classList.add("open");

        }





        // open read more text

        function readMoreToggle(toggle){

            toggle.addEventListener( "click", function(e) {

                //console.log('click');

                var id = this.dataset.id;

                this.style.display = 'none';

                //$(this).hide();

                var tar = 'close__'+id;


                var toggleLess = document.getElementById(tar);
                toggleLess.style.display = 'block';

                var readMore = document.getElementById(id);

                (toggleLess.classList.contains("active") === true) ? toggleLess.classList.remove("active") : toggleLess.classList.add("active");

                (readMore.classList.contains("active") === true) ? readMore.classList.remove("active") : readMore.classList.add("active");



            });

        }

        var readLessToggles = document.querySelectorAll(".toggle__less");
        for (var i = readLessToggles.length - 1; i >= 0; i--) {
            var toggle = readLessToggles[i];
            readLessToggle(toggle);
        }


        // close readmore again

        function readLessToggle(toggle){

            toggle.addEventListener( "click", function(e) {

                //console.log('click');

                var id = this.dataset.id;

                //$(this).hide();

                var tar = 'close__'+id;

                var open = 'open__'+id;

                var toggleLess = document.getElementById(tar);

                var readMore = document.getElementById(id);

                var readMoreOpen = document.getElementById(open);

                readMoreOpen.classList.add('active');

                $('#'+open).css('visibility', 'visibile');
                $('#'+open).css('opacity', 1);
                $('#'+open).show();

                $('#'+open).addClass('active');


                (toggleLess.classList.contains("active") === true) ? toggleLess.classList.remove("active") : toggleLess.classList.add("active");

                (readMoreOpen.classList.contains("active") === true) ? readMoreOpen.classList.remove("active") : readMoreOpen.classList.add("active");


                (readMore.classList.contains("active") === true) ? readMore.classList.remove("active") : readMore.classList.add("active");



            });

        }

        // Adding captcha on change.

        captchaHandler();

        function captchaHandler(){

            var captcha = $('.captcha');

             // form fields are completely filled

                $('.mc4wp-form input').change(function(){


                    var isValid = true;
                    $('.mc4wp-form input.form-field').each(function() {
                        if ( $(this).val() === '' )
                            isValid = false;
                    });
                    if(isValid){
                        captcha.css('visibility', 'visible');
                        captcha.css('max-height', '100px');
                    }
                });



        }

        // attachcalendar on newsletter form

        attachCalendar();

        function attachCalendar(){

            var today = new Date();
            var Dateoptions = {year: '2-digit', month: '2-digit', day: '2-digit' };
            var ddd = new Date().toLocaleString('en-US', Dateoptions);

            // Initialize all input of date type.
            var options = {
                displayMode: 'dialog',
                showFooter: false,
                showHeader: false,
                startDate: new Date(),
                minDate: ddd,
                maxDate: '12/31/2099'
            };

            var calendars = bulmaCalendar.attach('[id="MMERGE3"]', options);

        // Loop on each calendar initialized
            for(var i = 0; i < calendars.length; i++) {
                // Add listener to date:selected event
                calendars[i].on('date:selected', function(e){
                    console.log(e.start);
                    var pregnancyWeek = calculatePregnancyDate(new Date(e.start));
                    $('#updatedWeekPregnancy').val(pregnancyWeek);
            });
            }
        }

        function calculatePregnancyDate(dueDate){

                var nowDate = new Date();
                if (!dueDate) {
                    return null
                }

                var PregnancyWeeks = 40;
                var WeekMilliseconds = 604800000;

                var startDate = dueDate.getTime() - (PregnancyWeeks * WeekMilliseconds) - 1
                var diff = (((nowDate && nowDate.getTime()) || Date.now()) - startDate) / WeekMilliseconds

                if (diff < 0) {
                    return null
                }

                console.log(Math.ceil(diff));

                return Math.ceil(diff);

        }


        // functions for scrolling to the top!

        var offset = 0;
        var call;

        document.querySelector('#scrollToTop').addEventListener("click", scrollToTop);


        function scroll() {
            if ((offset - document.documentElement.scrollTop) > 0) {
                document.documentElement.scrollTop += 10
            }
            else if ((offset - document.documentElement.scrollTop) < 0) {
                document.documentElement.scrollTop -= 10
            }
            else {
                clearInterval(call)
            }
        };

        // scrolltop functionality

        function scrollToTop(e) {
            e.preventDefault();
            call = setInterval(scroll, 2);
            var target = e.srcElement.dataset.scroll;
            offset = document.getElementById('masthead').offsetTop
        }


        // if resize, activate slick

        // window.addEventListener("resize", function() {
        //     if (window.matchMedia("(max-width: 760px)").matches) {
        //         var observer = lozad();
        //         observer.observe();
        //         $('.carousel').slick({
        //             'rows': 1,
        //             'slidesPerRow': 1,
        //             'slidesToShow': 1,
        //             'lazyload': 'ondemand',
        //             'prevArrow': '<span class="prevArrow"></span>',
        //             'nextArrow': '<span class="nextArrow"></span>'
        //         });
        //     } else {
        //     }
        // });


        // * Press Hover Element **//

        var $press = $('.press__link');


        /* Modals job Jobs page */
        // Modals

        var rootEl = document.documentElement;
        var $modals = $('.modal');
        var $modalButtons = $('.job');
        var $modalCloses = $('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button');

        if ($modalButtons.length > 0) {
            $modalButtons.each(function() {
                $(this).on('click', function () {
                    var target = $(this).data('target');
                    openModal(target);

                    // prefil our form
                    prefillForm(target);
                });
            });
        }

        if ($modalCloses.length > 0) {
            $modalCloses.each(function () {
                $(this).on('click', function () {
                    closeModals();
                });
            });
        }

        // general applicaton modal


        var rootEl = document.documentElement;
        var $modals = $('.modal');
        var $generalModalButtons = $('.open-general-form');
        var $generalModalCloses = $('#modal-general-application .modal-close');

        if ($generalModalButtons.length > 0) {
            $generalModalButtons.on('click', function (event) {
                event.preventDefault();
                openModal('modal-general-application');
                var $form = $('#modal-general-application .has-form');
                $form.addClass('is-active');
            });
        }

        if ($generalModalCloses.length > 0) {

            $generalModalCloses.on('click', function (event) {
                closeModals();
            });
        }

        var $newsletterModalButtons = $('.open-newsletter');
        var $newsletterModalCloses = $('#modal-newsletter .modal-close');

        if ($newsletterModalButtons.length > 0) {
            $newsletterModalButtons.on('click', function (event) {
                event.preventDefault();
                openModal('modal-newsletter');
            });
        }

        if ($newsletterModalCloses.length > 0) {
            $newsletterModalCloses.on('click', function (event) {
                closeModals();
            });
        }

        var $signupModalButtons = $('.open-signup');
        var $signupModalCloses = $('#modal-signup .modal-close');

        if ($signupModalButtons.length > 0) {
            $signupModalButtons.on('click', function (event) {
                event.preventDefault();
                openModal('modal-signup');
            });
        }

        if ($signupModalCloses.length > 0) {
            $signupModalCloses.on('click', function (event) {
                closeModals();
            });
        }
        // open modal

        function openModal(target) {
            var $target = document.getElementById(target);

            rootEl.classList.add('is-clipped');
            $target.classList.add('is-active');


        }

        function closeModals() {
            rootEl.classList.remove('is-clipped');
            $modals.each(function () {
                $(this).removeClass('is-active');
            });
        }

        // closing modal

        document.addEventListener('keydown', function (event) {
            var e = event || window.event;
            if (e.keyCode === 27) {
                closeModals();}
        });

        // for closing / opening application form in jobs template

        var $openFormBtn = $('.open-form');
        var $closeFormBtn = $('.close-form');

        if($openFormBtn.length !== 0) {

            $openFormBtn.on('click', function (event) {
                event.preventDefault();
                openFormField($(this));
            });

            $closeFormBtn.on('click', function (event) {
                event.preventDefault();
                closeFormField($(this));
            });



        }

        // prefil application form

        function prefillForm(target){

            var $target = '#'+target;

            var title = $($target).find('.has-form').data('job');

            var $select = $($target).find('.wpcf7 select');

            $select.append('<option value="'+title+'" selected="selected">'+title+'</option>');

        }

        // close application form

        function closeFormField(target){
            var $target = '#'+target.data('id');
            var $form = $($target);
            $form.removeClass('is-active');
        }

        // open it on apply

        function openFormField(target){
            var $target = '#'+target.data('id');
            var $form = $($target);
            $form.addClass('is-active');
            var element = document.querySelector("input[type='submit']");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});




        }

        // blog carousel

        var ua = navigator.userAgent.toLowerCase();
        var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
        if(ua.indexOf("mobile") && $(window).width() < 960) {

            var $blogCarousel = $('.blog-carousel').flickity({
                pageDots: false,
                groupCells: 1,
                wrapAround: false,
                contain: true,
                freeScroll: false,
                draggable:true,
                lazyload:true,
                prevNextButtons: true,
                adaptiveHeight:true
            });

            var $carousel = $('.category-carousel').flickity({
                pageDots: false,
                groupCells: 1,
                wrapAround: false,
                contain: true,
                freeScroll: false,
                draggable:true,
                lazyload:true,
                prevNextButtons: true,
                adaptiveHeight:true
            });
        } else {
                var $blogCarousel = $('.blog-carousel').flickity({
                    pageDots: false,
                    groupCells: 2,
                    wrapAround: false,
                    contain: true,
                    freeScroll: false,
                    draggable:true,
                    lazyload:true,
                    prevNextButtons: true,
                    adaptiveHeight:true
                });

            var $carousel = $('.category-carousel').flickity({
                pageDots: false,
                groupCells: 2,
                wrapAround: false,
                contain: true,
                freeScroll: false,
                draggable:true,
                lazyload:true,
                prevNextButtons: true,
                adaptiveHeight:true
            });
            }






        var $carousel = $('.related-posts-carousel').flickity({
            groupCells: false,
            wrapAround: true,
            autoPlay: 10000,
            pauseAutoPlayOnHover: true,
            fade: true,
            draggable: true,
            imagesLoaded: true,
            contain: false,
            pageDots: false
        });





        // new carousel

        var $carousel = $('.carousel').flickity({
            groupCells: false,
            wrapAround: true,
            autoPlay: 10000,
            pauseAutoPlayOnHover: true,
            fade: true,
            draggable: true,
            imagesLoaded: true,
            contain: false,
            pageDots: false
        });

        $('.carousel').on( 'click', '.carousel-cell', function() {
            $('.carousel').find('.centered').removeClass('centered');
            $(this).addClass('centered');

            var index = $(this).index();
            $carousel.flickity( 'selectCell', index );
        });

        // activate slick on smaller screens

        // if ($(window).width() < 768) {
        //
        //     $('.carousel').slick({
        //         'rows': 1,
        //         'slidesPerRow': 1,
        //         'slidesToShow': 1,
        //         'lazyload': 'ondemand',
        //         'prevArrow': '<span class="prevArrow"></span>',
        //         'nextArrow': '<span class="nextArrow"></span>'
        //     });
        // }



    });

    /* small carousel needed for the experts section */

    $(function(){


        // Exit intent
        function addEvent(obj, evt, fn) {
            if (obj.addEventListener) {
                obj.addEventListener(evt, fn, false);
            } else if (obj.attachEvent) {
                obj.attachEvent("on" + evt, fn);
            }
        }


        // Exit intent trigger
        addEvent(document, 'mouseout', function(evt) {
            if (evt.toElement === null && evt.relatedTarget === null && !localStorage.getItem('exitintent_show')) {
                var rootEl = document.documentElement;

                var $target = document.getElementById('modal-newsletter');
                rootEl.classList.add('is-clipped');
                $target.classList.add('is-active');

                localStorage.setItem('exitintent_show', 'true'); // Set the flag in localStorage
            }
        });





        var front = $('.front'),
            others = ['left2', 'left', 'right', 'right2'];

        // start rotating automatically

        rotateItems();

        // or open on click

        function start(){

            var $start = $('.front');
            $start.removeClass('front');

            var $right = $('.right');
            var $left = $('.left');
            $right.removeClass('right');
            $left.removeClass('left');
            $left.addClass('front');
            $right.addClass('left');
            $start.addClass('right');
            $('.carousel').on('click', '.item', function() {

                var item = $(this);

                if(item.hasClass('left')){
                    item.removeClass('left');
                    $('.carousel .item.front').removeClass('front').addClass('left');
                    item.addClass('front');
                }

                if(item.hasClass('right')){
                    item.removeClass('right');
                    $('.carousel .item.front').removeClass('front').addClass('right');
                    item.addClass('front');
                }

            });



        }

        function rotateItems(){

            setInterval(function() {
                // method to be executed;
                start();
            }, 10000);


        }

        //setInterval(rotateItems, 3000);
    });




} ( jQuery, window ) );


CLI_ACCEPT_COOKIE_NAME =(typeof CLI_ACCEPT_COOKIE_NAME !== 'undefined' ? CLI_ACCEPT_COOKIE_NAME : 'viewed_cookie_policy');
CLI_ACCEPT_COOKIE_EXPIRE =(typeof CLI_ACCEPT_COOKIE_EXPIRE !== 'undefined' ? CLI_ACCEPT_COOKIE_EXPIRE : 365);
CLI_COOKIEBAR_AS_POPUP=(typeof CLI_COOKIEBAR_AS_POPUP !== 'undefined' ? CLI_COOKIEBAR_AS_POPUP : false);
var CLI_Cookie={
    set: function (name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        } else
            var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
        if(days<1)
        {
            host_name=window.location.hostname;
            document.cookie = name + "=" + value + expires + "; path=/; domain=."+host_name+";";
            host_name=host_name.substring(host_name.lastIndexOf(".", host_name.lastIndexOf(".")-1));
            document.cookie = name + "=" + value + expires + "; path=/; domain="+host_name+";";
        }
    },
    read: function (name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return null;
    },
    erase: function (name) {
        this.set(name, "", -10);
    },
    exists: function (name) {
        return (this.read(name) !== null);
    },
    getallcookies:function()
    {
        var pairs = document.cookie.split(";");
        var cookieslist = {};
        for (var i = 0; i < pairs.length; i++) {
            var pair = pairs[i].split("=");
            cookieslist[(pair[0] + '').trim()] = unescape(pair[1]);
        }
        return cookieslist;
    }
}
var CLI=
    {
        bar_config:{},
        showagain_config:{},
        set:function(args)
        {
            if(typeof JSON.parse !== "function")
            {
                console.log("CookieLawInfo requires JSON.parse but your browser doesn't support it");
                return;
            }
            this.settings = JSON.parse(args.settings);
            this.bar_elm=jQuery(this.settings.notify_div_id);
            this.showagain_elm = jQuery(this.settings.showagain_div_id);

            //buttons
            this.main_button=jQuery('.cli-plugin-main-button');
            this.main_link = jQuery('.cli-plugin-main-link');
            this.reject_link = jQuery('.cookie_action_close_header_reject');
            this.delete_link=jQuery(".cookielawinfo-cookie-delete");

            if(this.settings.cookie_bar_as=='popup')
            {
                CLI_COOKIEBAR_AS_POPUP=true;
            }
            this.configBar();
            this.toggleBar();
            this.attachDelete();
            this.attachEvents();
            this.configButtons();
            if(this.settings.scroll_close === true)
            {
                window.addEventListener("scroll",CLI.closeOnScroll, false);
            }
        },
        attachEvents:function()
        {
            jQuery('.cli_action_button').click(function(e){
                e.preventDefault();
                var elm=jQuery(this);
                var button_action=elm.attr('data-cli_action');
                var open_link=elm[0].hasAttribute("href") && elm.attr("href") != '#' ? true : false;
                var new_window=false;
                if(button_action=='accept')
                {
                    CLI.accept_close();
                    new_window=CLI.settings.button_1_new_win ? true : false;
                }else if(button_action=='reject')
                {
                    CLI.reject_close();
                    new_window=CLI.settings.button_3_new_win ? true : false;
                }
                CLI.saveLog(button_action);
                if(open_link)
                {
                    if(new_window)
                    {
                        window.open(elm.attr("href"),'_blank');
                    }else
                    {
                        window.location.href =elm.attr("href");
                    }
                }
            });
        },
        saveLog:function(button_action)
        {
            if(CLI.settings.logging_on)
            {
                jQuery.ajax({
                    url: log_object.ajax_url,
                    type: 'POST',
                    data:{
                        action: 'wt_log_visitor_action',
                        wt_clicked_button_id: '',
                        wt_user_action:button_action,
                        cookie_list:CLI_Cookie.getallcookies()
                    },
                    success:function (response)
                    {

                    }
                });
            }
        },
        attachDelete:function()
        {
            this.delete_link.click(function () {
                CLI_Cookie.erase(CLI_ACCEPT_COOKIE_NAME);
                for(var k in Cli_Data.nn_cookie_ids)
                {
                    CLI_Cookie.erase(Cli_Data.nn_cookie_ids[k]);
                }
                return false;
            });
        },
        configButtons:function()
        {
            //[cookie_button]
            this.main_button.css('color',this.settings.button_1_link_colour);
            if(this.settings.button_1_as_button)
            {
                this.main_button.css('background-color',this.settings.button_1_button_colour);
                this.main_button.hover(function () {
                    jQuery(this).css('background-color',CLI.settings.button_1_button_hover);
                },function (){
                    jQuery(this).css('background-color',CLI.settings.button_1_button_colour);
                });
            }

            //[cookie_link]
            this.main_link.css('color',this.settings.button_2_link_colour);
            if(this.settings.button_2_as_button)
            {
                this.main_link.css('background-color',this.settings.button_2_button_colour);
                this.main_link.hover(function () {
                    jQuery(this).css('background-color',CLI.settings.button_2_button_hover);
                },function (){
                    jQuery(this).css('background-color',CLI.settings.button_2_button_colour);
                });
            }


            //[cookie_reject]
            this.reject_link.css('color',this.settings.button_3_link_colour);
            if(this.settings.button_3_as_button)
            {
                this.reject_link.css('background-color',this.settings.button_3_button_colour);
                this.reject_link.hover(function () {
                    jQuery(this).css('background-color',CLI.settings.button_3_button_hover);
                },function () {
                    jQuery(this).css('background-color',CLI.settings.button_3_button_colour);
                });
            }
        },
        toggleBar:function()
        {
            if(CLI_COOKIEBAR_AS_POPUP)
            {
                this.barAsPopUp(1);
            }
            if(CLI.settings.cookie_bar_as=='widget')
            {
                this.barAsWidget(1);
            }
            if(!CLI_Cookie.exists(CLI_ACCEPT_COOKIE_NAME))
            {
                this.displayHeader();
            } else {
                this.bar_elm.hide();
            }
            if(this.settings.show_once_yn)
            {
                setTimeout(function(){
                    CLI.close_header();
                },CLI.settings.show_once);
            }

            this.showagain_elm.click(function (e) {
                e.preventDefault();
                CLI.showagain_elm.slideUp(CLI.settings.animate_speed_hide,function()
                {
                    CLI.bar_elm.slideDown(CLI.settings.animate_speed_show);
                    if(CLI_COOKIEBAR_AS_POPUP)
                    {
                        CLI.showPopupOverlay();
                    }
                });
            });
        },
        configShowAgain:function()
        {
            this.showagain_config = {
                'background-color': this.settings.background,
                'color':this.l1hs(this.settings.text),
                'position': 'fixed',
                'font-family': this.settings.font_family
            };
            if(this.settings.border_on)
            {
                var border_to_hide = 'border-' + this.settings.notify_position_vertical;
                this.showagain_config['border'] = '1px solid ' + this.l1hs(this.settings.border);
                this.showagain_config[border_to_hide] = 'none';
            }
            var cli_win=jQuery(window);
            var cli_winw=cli_win.width();
            var showagain_x_pos=this.settings.showagain_x_position;
            if(cli_winw<300)
            {
                showagain_x_pos=10;
                this.showagain_config.width=cli_winw-20;
            }else
            {
                this.showagain_config.width='auto';
            }
            var cli_defw=cli_winw>400 ? 500 : cli_winw-20;
            if(CLI_COOKIEBAR_AS_POPUP) //cookie bar as popup
            {
                var sa_pos=this.settings.popup_showagain_position;
                var sa_pos_arr=sa_pos.split('-');
                if(sa_pos_arr[1]=='left')
                {
                    this.showagain_config.left=showagain_x_pos;
                }else if(sa_pos_arr[1]=='right')
                {
                    this.showagain_config.right=showagain_x_pos;
                }
                if(sa_pos_arr[0]=='top')
                {
                    this.showagain_config.top=0;

                }else if(sa_pos_arr[0]=='bottom')
                {
                    this.showagain_config.bottom=0;
                }
                this.bar_config['position'] = 'fixed';

            }else if(this.settings.cookie_bar_as=='widget')
            {
                this.showagain_config.bottom=0;
                if(this.settings.widget_position=='left')
                {
                    this.showagain_config.left=showagain_x_pos;
                }else if(this.settings.widget_position=='right')
                {
                    this.showagain_config.right=showagain_x_pos;
                }
            }
            else
            {
                if(this.settings.notify_position_vertical == "top")
                {
                    this.showagain_config.top = '0';
                }
                else if(this.settings.notify_position_vertical == "bottom")
                {
                    this.bar_config['position'] = 'fixed';
                    this.bar_config['bottom'] = '0';
                    this.showagain_config.bottom = '0';
                }
                if(this.settings.notify_position_horizontal == "left")
                {
                    this.showagain_config.left =showagain_x_pos;
                }else if(this.settings.notify_position_horizontal == "right")
                {
                    this.showagain_config.right =showagain_x_pos;
                }
            }
            this.showagain_elm.css(this.showagain_config);
        },
        configBar:function()
        {
            this.bar_config = {
                'background-color':this.settings.background,
                'color':this.settings.text,
                'font-family':this.settings.font_family
            };
            if(this.settings.notify_position_vertical=="top")
            {
                this.bar_config['top'] = '0';
                if(this.settings.header_fix === true)
                {
                    this.bar_config['position'] = 'fixed';
                }
            }else
            {
                this.bar_config['bottom'] = '0';
            }
            this.configShowAgain();
            this.bar_elm.css(this.bar_config).hide();
        },
        l1hs:function(str)
        {
            if (str.charAt(0) == "#") {
                str = str.substring(1, str.length);
            } else {
                return "#" + str;
            }
            return this.l1hs(str);
        },
        close_header:function()
        {
            CLI_Cookie.set(CLI_ACCEPT_COOKIE_NAME,'yes',CLI_ACCEPT_COOKIE_EXPIRE);
            this.hideHeader();
        },
        accept_close:function()
        {
            this.hidePopupOverlay();
            CLI_Cookie.set(CLI_ACCEPT_COOKIE_NAME,'yes',CLI_ACCEPT_COOKIE_EXPIRE);
            if(this.settings.notify_animate_hide)
            {
                this.bar_elm.slideUp(this.settings.animate_speed_hide);
            }else
            {
                this.bar_elm.hide();
            }
            this.showagain_elm.slideDown(this.settings.animate_speed_show);
            if(this.settings.accept_close_reload === true)
            {
                this.reload_current_page();
            }
            return false;
        },
        reject_close:function()
        {
            this.hidePopupOverlay();
            for(var k in Cli_Data.nn_cookie_ids)
            {
                CLI_Cookie.erase(Cli_Data.nn_cookie_ids[k]);
            }
            CLI_Cookie.set(CLI_ACCEPT_COOKIE_NAME,'no',CLI_ACCEPT_COOKIE_EXPIRE);
            if(this.settings.notify_animate_hide)
            {
                this.bar_elm.slideUp(this.settings.animate_speed_hide);
            } else
            {
                this.bar_elm.hide();
            }
            this.showagain_elm.slideDown(this.settings.animate_speed_show);
            if(this.settings.reject_close_reload === true)
            {
                this.reload_current_page();
            }
            return false;
        },
        reload_current_page:function()
        {
            if(typeof cli_flush_cache!=='undefined' && cli_flush_cache==1)
            {
                window.location.href=this.add_clear_cache_url_query();
            }else
            {
                window.location.reload(true);
            }
        },
        add_clear_cache_url_query:function()
        {
            var cli_rand=new Date().getTime()/1000;
            var cli_url=window.location.href;
            var cli_hash_arr=cli_url.split('#');
            var cli_urlparts= cli_hash_arr[0].split('?');
            if(cli_urlparts.length>=2)
            {
                var cli_url_arr=cli_urlparts[1].split('&');
                cli_url_temp_arr=new Array();
                for(var cli_i=0; cli_i<cli_url_arr.length; cli_i++)
                {
                    var cli_temp_url_arr=cli_url_arr[cli_i].split('=');
                    if(cli_temp_url_arr[0]=='cli_action')
                    {

                    }else
                    {
                        cli_url_temp_arr.push(cli_url_arr[cli_i]);
                    }
                }
                cli_urlparts[1]=cli_url_temp_arr.join('&');
                cli_url=cli_urlparts.join('?')+(cli_url_temp_arr.length>0 ? '&': '')+'cli_action=';
            }else
            {
                cli_url=cli_hash_arr[0]+'?cli_action=';
            }
            cli_url+=cli_rand;
            if(cli_hash_arr.length>1)
            {
                cli_url+='#'+cli_hash_arr[1];
            }
            return cli_url;
        },
        closeOnScroll:function()
        {
            if(window.pageYOffset > 100 && !CLI_Cookie.read(CLI_ACCEPT_COOKIE_NAME))
            {
                CLI.accept_close();
                if(CLI.settings.scroll_close_reload === true)
                {
                    window.location.reload();
                }
                window.removeEventListener("scroll",CLI.closeOnScroll,false);
            }
        },
        displayHeader:function()
        {
            if(this.settings.notify_animate_show)
            {
                this.bar_elm.slideDown(this.settings.animate_speed_show);
            }else
            {
                this.bar_elm.show();
            }
            this.showagain_elm.hide();
            if(CLI_COOKIEBAR_AS_POPUP)
            {
                this.showPopupOverlay();
            }
        },
        hideHeader:function()
        {
            if(this.settings.notify_animate_show)
            {
                this.showagain_elm.slideDown(this.settings.animate_speed_show);
            } else {
                this.showagain_elm.show();
            }
            this.bar_elm.slideUp(this.settings.animate_speed_show);
            this.hidePopupOverlay();
        },
        hidePopupOverlay:function()
        {
            jQuery('body').removeClass("cli-barmodal-open");
            jQuery(".cli-popupbar-overlay").removeClass("cli-show");
        },
        showPopupOverlay:function()
        {
            if(this.settings.popup_overlay)
            {
                jQuery('body').addClass("cli-barmodal-open");
                jQuery(".cli-popupbar-overlay").addClass("cli-show");
            }
        },
        barAsWidget:function(a)
        {
            var cli_elm=this.bar_elm;
            var cli_win=jQuery(window);
            var cli_winh=cli_win.height()-40;
            var cli_winw=cli_win.width();
            var cli_defw=cli_winw>400 ? 300 : cli_winw-30;
            cli_elm.css({
                'width':cli_defw,'height':'auto','max-height':cli_winh,'padding':'25px 15px','overflow':'auto','position':'fixed'
            });
            if(this.settings.widget_position=='left')
            {
                cli_elm.css({
                    'left':'15px','right':'auto','bottom':'15px','top':'auto'
                });
            }else
            {
                cli_elm.css({
                    'left':'auto','right':'15px','bottom':'15px','top':'auto'
                });
            }
            if(a)
            {
                this.setResize();
            }
        },
        barAsPopUp:function(a)
        {
            if(typeof cookie_law_info_bar_as_popup==='function')
            {
                return false;
            }
            var cli_elm=this.bar_elm;
            var cli_win=jQuery(window);
            var cli_winh=cli_win.height()-40;
            var cli_winw=cli_win.width();
            var cli_defw=cli_winw>700 ? 500 : cli_winw-20;

            cli_elm.css({
                'width':cli_defw,'height':'auto','max-height':cli_winh,'bottom':'','top':'50%','left':'50%','margin-left':(cli_defw/2)*-1,'margin-top':'-100px','padding':'25px 15px','overflow':'auto'
            }).addClass('cli-bar-popup cli-modal-content');


            cli_h=cli_elm.height();
            li_h=cli_h<200 ? 200 : cli_h;
            cli_elm.css({'top':'50%','margin-top':((cli_h/2)+30)*-1});
            setTimeout(function(){
                cli_elm.css({
                    'bottom':''
                });
            },100);
            if(a)
            {
                this.setResize();
            }
        },
        setResize:function()
        {
            var resizeTmr=null;
            jQuery(window).resize(function() {
                clearTimeout(resizeTmr);
                resizeTmr=setTimeout(function()
                {
                    if(CLI_COOKIEBAR_AS_POPUP)
                    {
                        CLI.barAsPopUp();
                    }
                    if(CLI.settings.cookie_bar_as=='widget')
                    {
                        CLI.barAsWidget();
                    }
                    CLI.configShowAgain();
                },500);
            });
        }
    }
jQuery(document).ready(function() {
    if(typeof cli_cookiebar_settings!='undefined')
    {
        CLI.set({
            settings:cli_cookiebar_settings
        });
    }
});

