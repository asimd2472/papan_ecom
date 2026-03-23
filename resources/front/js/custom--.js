$(function () {
    /*-------------------------------------Header Fixed-------------------------*/
    "use strict";
    // $(function () {
    //     var header = $(".start-style");
    //     $(window).scroll(function () {
    //         var scroll = $(window).scrollTop();

    //         if (scroll >= 10) {
    //             header.removeClass('start-style').addClass("scroll-on");
    //         } else {
    //             header.removeClass("scroll-on").addClass('start-style');
    //         }
    //     });
    // });

    /*-------------------------------------Mobile Menu-------------------------*/
    var ico = $('<span></span>');
    $('li.sub_menu_open').append(ico);

    $("#menu_res").click(function () {
        $("#res_nav").toggleClass('left0');
    });

    $('li span').on("click", function (e) {
        if ($(this).hasClass('open')) {

            $(this).prev('ul').slideUp(300, function () { });

        } else {
            $(this).prev('ul').slideDown(300, function () { });
        }
        $(this).toggleClass("open");
    });
    $('#menu_res').click(function () {
        $(this).toggleClass('menu_responsiveTo')
    });



    /*-------------------------------------ScrollTop-------------------------*/

    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('.scrollup').fadeIn();
            $('.arrow-show').fadeIn();
        } else {
            $('.scrollup').fadeOut();
            $('.arrow-show').fadeOut();
        }
    });
    $('.scrollup').click(function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, 300);
        return false;
    });


    /* ===============================  Scroll back to top  =============================== */

    $(document).ready(function () {
        "use strict";

        var progressPath = document.querySelector('.progress-wrap path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);
        var offset = 150;
        var duration = 550;
        jQuery(window).on('scroll', function () {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.progress-wrap').addClass('active-progress');
            } else {
                jQuery('.progress-wrap').removeClass('active-progress');
            }
        });
        jQuery('.progress-wrap').on('click', function (event) {
            event.preventDefault();
            jQuery('html, body').animate({ scrollTop: 0 }, duration);
            return false;
        })


    });


    /* ===============================  Mouse effect  =============================== */

    // function mousecursor() {
    //     if ($("body")) {
    //         const e = document.querySelector(".cursor-inner"),
    //             t = document.querySelector(".cursor-outer");
    //         let n, i = 0,
    //             o = !1;
    //         window.onmousemove = function (s) {
    //             o || (t.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)"), e.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)", n = s.clientY, i = s.clientX
    //         }, $("body").on("mouseenter", "a, .cursor-pointer", function () {
    //             e.classList.add("cursor-hover"), t.classList.add("cursor-hover")
    //         }), $("body").on("mouseleave", "a, .cursor-pointer", function () {
    //             $(this).is("a") && $(this).closest(".cursor-pointer").length || (e.classList.remove("cursor-hover"), t.classList.remove("cursor-hover"))
    //         }), e.style.visibility = "visible", t.style.visibility = "visible"
    //     }
    // };

    // $(function () {
    //     mousecursor();
    // });


    // hambergar
    // var forEach = function (t, o, r) { if ("[object Object]" === Object.prototype.toString.call(t)) for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t); else for (var e = 0, l = t.length; l > e; e++)o.call(r, t[e], e, t) };

    // var hamburgers = document.querySelectorAll(".hamburger");
    // if (hamburgers.length > 0) {
    //     forEach(hamburgers, function (hamburger) {
    //         hamburger.addEventListener("click", function () {
    //             this.classList.toggle("is-active");
    //         }, false);
    //     });
    // }

    //vfdgdfg
    function scrollContainer() {
        var cont = document.querySelector('.cont-image');
        var title = document.querySelector('.title');
        var y = window.scrollY;
        if (y > 50) {
            cont.classList.add('scrolled');
            title.classList.add('fade');
        }
        else {
            cont.classList.remove('scrolled');
            title.classList.remove('fade');
        }
    }
    window.addEventListener('scroll', scrollContainer);



    // menu

    var ico = $('<span></span>');
    $('li.sub_menu_open').append(ico);

    $(".hamburger-box").on("click", function () {
        $(".navigation").toggleClass('active');
        $(".navBg").toggleClass('active');
    });
    $(".navBg").on("click", function () {
        $(".navigation").removeClass('active');
        $(this).removeClass('active');
        $(".hamburger").removeClass('is-active');
    });

    // $('li span').on("click", function(e) {
    //     if ($(this).hasClass('open')) {

    //         $(this).prev('ul').slideUp(300, function() {});

    //     } else {
    //         $(this).prev('ul').slideDown(300, function() {});
    //     }
    //     $(this).toggleClass("open");
    // });
    $('#menu_res').click(function () {
        $(this).toggleClass('menu_responsiveTo')
    });

    // menu
    $(".hamburger").on("click", function () {
        $(".dashboardLeft").toggleClass('open');
    });

    // tabs
    $("#tile-1 .nav-tabs .nav-link").click(function() {
        var position = $(this).parent().position();
        var width = $(this).parent().width();
          $("#tile-1 .slider").css({"left":+ position.left,"width":width});
      });
      var actWidth = $("#tile-1 .nav-tabs").find(".active").parent("li").width();
      var actPosition = $("#tile-1 .nav-tabs .active").position();
      $("#tile-1 .slider").css({"left":+ actPosition.left,"width": actWidth});
      // tabs


      
    
    
});
