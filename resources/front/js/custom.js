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
    var ico = $("<span></span>");
    $("li.sub_menu_open").append(ico);

    $("#menu_res").click(function () {
        $("#res_nav").toggleClass("left0");
    });

    $("li span").on("click", function (e) {
        if ($(this).hasClass("open")) {
            $(this)
                .prev("ul")
                .slideUp(300, function () {});
        } else {
            $(this)
                .prev("ul")
                .slideDown(300, function () {});
        }
        $(this).toggleClass("open");
    });
    $("#menu_res").click(function () {
        $(this).toggleClass("menu_responsiveTo");
    });

    /*-------------------------------------ScrollTop-------------------------*/

    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $(".scrollup").fadeIn();
            $(".arrow-show").fadeIn();
        } else {
            $(".scrollup").fadeOut();
            $(".arrow-show").fadeOut();
        }
    });
    $(".scrollup").click(function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, 300);
        return false;
    });

    /* ===============================  Scroll back to top  =============================== */

    $(document).ready(function () {
        "use strict";

        var progressPath = document.querySelector(".progress-wrap path");
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition =
            "none";
        progressPath.style.strokeDasharray = pathLength + " " + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition =
            "stroke-dashoffset 10ms linear";
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength) / height;
            progressPath.style.strokeDashoffset = progress;
        };
        updateProgress();
        $(window).scroll(updateProgress);
        var offset = 150;
        var duration = 550;
        jQuery(window).on("scroll", function () {
            if (jQuery(this).scrollTop() > offset) {
                jQuery(".progress-wrap").addClass("active-progress");
            } else {
                jQuery(".progress-wrap").removeClass("active-progress");
            }
        });
        jQuery(".progress-wrap").on("click", function (event) {
            event.preventDefault();
            jQuery("html, body").animate({ scrollTop: 0 }, duration);
            return false;
        });
    });

    /* ===============================  Mouse effect  =============================== */

    //vfdgdfg
    function scrollContainer() {
        var cont = document.querySelector(".cont-image");
        var title = document.querySelector(".title");
        var y = window.scrollY;
        if (y > 50) {
            if (cont !== null) {
                cont.classList.add("scrolled");
            }
            if (title !== null) {
                title.classList.add("fade");
            }
        } else {
            if (cont !== null) {
                cont.classList.remove("scrolled");
            }
            if (title !== null) {
                title.classList.remove("fade");
            }
        }
    }
    window.addEventListener("scroll", scrollContainer);

    // menu

    var ico = $("<span></span>");
    $("li.sub_menu_open").append(ico);

    $(".hamburger-box").on("click", function () {
        $(".navigation").toggleClass("active");
        $(".navBg").toggleClass("active");
    });
    $(".navBg").on("click", function () {
        $(".navigation").removeClass("active");
        $(this).removeClass("active");
        $(".hamburger").removeClass("is-active");
    });
    $(".listToggleBtn").on("click", function () {
        $(this).closest(".listLeft").toggleClass("open");
    });

    // $('li span').on("click", function(e) {
    //     if ($(this).hasClass('open')) {

    //         $(this).prev('ul').slideUp(300, function() {});

    //     } else {
    //         $(this).prev('ul').slideDown(300, function() {});
    //     }
    //     $(this).toggleClass("open");
    // });
    $("#menu_res").click(function () {
        $(this).toggleClass("menu_responsiveTo");
    });

    // menu
    $(".hamburger").on("click", function () {
        $(".dashboardLeft").toggleClass("open");
    });

    // -------------------
    $(document).ready(function () {
        var bigimage = $("#big");
        var thumbs = $("#thumbs");
        //var totalslides = 10;
        var syncedSecondary = true;

        bigimage
            .owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: true,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                    '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
                ],
            })
            .on("changed.owl.carousel", syncPosition);

        thumbs
            .on("initialized.owl.carousel", function () {
                thumbs.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items: 4,
                dots: true,
                nav: false,
                navText: [
                    '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                    '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
                ],
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: 4,
                responsiveRefreshRate: 100,
            })
            .on("changed.owl.carousel", syncPosition2);

        function syncPosition(el) {
            //if loop is set to false, then you have to uncomment the next line
            //var current = el.item.index;

            //to disable loop, comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            //to this
            thumbs
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = thumbs.find(".owl-item.active").length - 1;
            var start = thumbs.find(".owl-item.active").first().index();
            var end = thumbs.find(".owl-item.active").last().index();

            if (current > end) {
                thumbs.data("owl.carousel").to(current, 100, true);
            }
            if (current < start) {
                thumbs.data("owl.carousel").to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                bigimage.data("owl.carousel").to(number, 100, true);
            }
        }

        thumbs.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            bigimage.data("owl.carousel").to(number, 300, true);
        });
    });

    /*-------------------------------------number-------------------------*/

    var qty = 0,
        maxlim,
        cartId,
        cartPrice;

    $(".priceControl .controls2").on("click", function () {
        qty = $(this).siblings(".qtyInput2").val();
        maxlim = $(this).siblings(".qtyInput2").attr("data-max-lim");
        cartId = $(this).siblings(".qtyInput2").attr("data-cart-id");
        cartPrice = $(this).siblings(".qtyInput2").attr("data-cart-amount");
        var totalCartItem = $("#totalCartItem_" + cartId).val();
        // alert(product_id);
        // console.log(maxlim);
        if ($(this).val() == "+" && parseInt(maxlim) > qty) {
            qty++;

            var sum = parseInt(totalCartItem) + 1;
            $("#totalCartItem_" + cartId).val(sum);
            var totalCartItem = $("#totalCartItem_" + cartId).val();
            cartUpdate(totalCartItem, cartId, cartPrice, 1);
        } else if ($(this).val() == "-" && qty > 1) {
            qty--;

            var sub = parseInt(totalCartItem) - 1;
            $(".decrementBtn").removeAttr("disabled");
            $("#totalCartItem_" + cartId).val(sub);
            var totalCartItem = $("#totalCartItem_" + cartId).val();
            cartUpdate(totalCartItem, cartId, cartPrice, 0);
        }
        $(this).siblings(".qtyInput2").val(qty);
    });
    /*-------------------------------------number-------------------------*/

    /*-------------------------------------Start Password Eye-------------------------*/
    $(document).on("click", ".pass_eye", function () {
        if (
            $(this).closest(".add_eye").find(".pass_input").attr("type") ==
            "password"
        ) {
            $(this)
                .closest(".add_eye")
                .find(".pass_input")
                .attr("type", "text");
            $(this)
                .closest(".add_eye")
                .find(".far")
                .addClass("fa-eye")
                .removeClass("fa-eye-slash");
        } else {
            $(this)
                .closest(".add_eye")
                .find(".pass_input")
                .attr("type", "password");
            $(this)
                .closest(".add_eye")
                .find(".far")
                .removeClass("fa-eye")
                .addClass("fa-eye-slash");
        }
    });
    /*-------------------------------------End Password Eye-------------------------*/

    /*-------------------------------------End Password Eye-------------------------*/
    window.my_account = function () {
        $(".menu-list").slideToggle();
    };
    // document.addEventListener("click", function (e) {
    //     var container = document.querySelector(".dropDown");
    //     if (!container.contains(e.target)) {
    //         $(".menu-list").slideUp();
    //     }
    //     e.stopPropagation();
    // });
    /*-------------------------------------End Password Eye-------------------------*/

    /*-------------------------------------User Sidebar Menu-----------------------------------*/
    $(document).on("click", ".sidebar_menu_btn", function () {
        $(".mobile_sidebar").slideToggle();
    });
    $(document).on("click", ".close-sidebar", function () {
        $(".mobile_sidebar").slideUp();
    });
});
