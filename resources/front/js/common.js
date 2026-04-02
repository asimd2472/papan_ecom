$(function() {
    "use strict";

    $("#customRoadForm").validate({
        ignore: [],
        rules: {
            "name": {
                required: true,
            },
            "email": {
                required: true,
            },
            "requirement": {
                required: true,
            },
        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#customRoadForm')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url + "/customrodsave",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $('#check_avb_btm').html('Please Wait...');
                    $('#check_avb_btm').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.status == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: data.msg,
                            icon: 'success',
                        });

                        $('#check_avb_btm').html('Submit');
                        $("#check_avb_btm").prop("disabled", false);

                    } else if (data.status == 0) {
                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });
                        $('#check_avb_btm').html('Submit');
                        $("#check_avb_btm").prop("disabled", false);
                    }
                }
            });
        }
    });


    $("#loginForm").validate({
        ignore: [],
        rules: {
            "email": {
                required: true,
            },
            "password": {
                required: true,
            },
        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#loginForm')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url + "/logincheck",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $('#check_avb_btm').html('Please Wait...');
                    $('#check_avb_btm').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.status == 1) {

                        location.reload();

                        $('#check_avb_btm').html('Submit');
                        $("#check_avb_btm").prop("disabled", false);

                    } else if (data.status == 0) {
                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });
                        $('#check_avb_btm').html('Submit');
                        $("#check_avb_btm").prop("disabled", false);
                    }
                }
            });
        }
    });

    // $("#paymentForm").validate({
    //     ignore: [],
    //     rules: {
    //         "name": {
    //             required: true,
    //         },
    //         "owner": {
    //             required: true,
    //         },
    //         "cardNumber": {
    //             required: true,
    //         },
    //         "cvv": {
    //             required: true,
    //         },
    //         "expiration-month": {
    //             required: true,
    //         },
    //         "expiration-year": {
    //             required: true,
    //         },
    //     },
    //     messages: {

    //     },
    //     errorElement: 'span',
    //     submitHandler: function(form) {

    //         var form = $('#paymentForm')[0];
    //         var formData = new FormData(form);
    //         event.preventDefault();

    //         console.log(formData);

    //         $.ajax({
    //             url: base_url + "/handleonlinepay",
    //             type: 'POST',
    //             processData: false,
    //             contentType: false,
    //             data: formData,
    //             beforeSend: function() {
    //                 $(".page-loader").show();
    //             },
    //             success: function(data) {
    //                 if (data.status == 1) {

    //                     // location.reload();

    //                     var url = base_url + "/order-success?transaction_id=" + data.transaction_id;
    //                     window.location.replace(url);

    //                     $(".page-loader").hide();

    //                 } else if (data.status == 0) {

    //                     $(".page-loader").hide();

    //                     Swal.fire({
    //                         title: 'Error',
    //                         text: data.msg,
    //                         icon: 'warning',
    //                     });

    //                 }
    //             }
    //         });
    //     }
    // });

    $("#step1").validate({
        ignore: [],
        rules: {
            "name": {
                required: true,
            },
            "address": {
                required: true,
            },
            "city": {
                required: true,
            },
            "state": {
                required: true,
            },
            "zipcode": {
                required: true,
            },
            "s_name": {
                required: true,
            },
            "s_address": {
                required: true,
            },
            "s_city": {
                required: true,
            },
            "s_state": {
                required: true,
            },
            "s_zipcode": {
                required: true,
            },
        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#step1')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url + "/save_customerdata",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $(".page-loader").show();
                },
                success: function(data) {
                    if (data.status == 1) {

                        $("#step1").hide();
                        $("#step2").show();

                        $(".li_stape1").removeClass("is-active");
                        $(".li_stape1").addClass("is-done");
                        $(".li_stape2").addClass("is-active");

                        $(".page-loader").hide();

                        removeCoupon();

                    } else if (data.status == 0) {

                        $(".page-loader").hide();

                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });

                    }
                }
            });


        }
    });


    $("#step2").validate({
        ignore: [],
        rules: {
            "method": {
                required: true,
            },
        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#step2')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url + "/get_customerdata",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $(".page-loader").show();
                },
                success: function(data) {
                    if (data.status == 1) {



                        $("#step2").hide();
                        $("#step3").show();

                        $(".li_stape2").removeClass("is-active");
                        $(".li_stape2").addClass("is-done");
                        $(".li_stape3").addClass("is-active");

                        // review data show

                        $(".name").html(data.costomer_data.name);
                        $(".address").html(data.costomer_data.address);
                        $(".city").html(data.costomer_data.city);
                        $(".state").html(data.costomer_data.state);
                        $(".zipcode").html(data.costomer_data.zipcode);
                        $(".s_name").html(data.costomer_data.s_name);
                        $(".s_address").html(data.costomer_data.s_address);
                        $(".s_city").html(data.costomer_data.s_city);
                        $(".s_state").html(data.costomer_data.s_state);
                        $(".s_zipcode").html(data.costomer_data.s_zipcode);
                        $(".email").html(data.costomer_data.email);
                        $(".phone").html(data.costomer_data.phone);

                        $(".service_name").html(data.shipping_charge_data.service_name);
                        $(".totalCharges").html("$"+data.shipping_charge_data.totalCharges);

                        $(".checkout_calculation_html").html(data.checkout_calculation_html);


                        $(".page-loader").hide();

                    } else if (data.status == 0) {

                        $(".page-loader").hide();

                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });

                    }
                }
            });


        }
    });

    $("#step3").validate({
        ignore: [],
        rules: {

            "owner": {
                required: true,
            },
            "cardNumber": {
                required: true,
            },
            "cvv": {
                required: true,
            },
            "expiration-month": {
                required: true,
            },
            "expiration-year": {
                required: true,
            },
        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#step3')[0];
            var formData = new FormData(form);
            event.preventDefault();

            console.log(formData);

            $.ajax({
                url: base_url + "/handleonlinepay",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $(".page-loader").show();
                },
                success: function(data) {
                    if (data.status == 1) {

                        // location.reload();

                        var url = base_url + "/order-success?transaction_id=" + data.transaction_id;
                        window.location.replace(url);

                        $(".page-loader").hide();

                    } else if (data.status == 0) {

                        $(".page-loader").hide();

                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });

                    }
                }
            });
        }
    });


    $("#OrderForm").validate({
        ignore: [],
        rules: {
        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#OrderForm')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url + "/place_order_cod",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $(".page-loader").show();
                },
                success: function(data) {
                    if (data.status == 1) {

                        var url = base_url + "/order-success?transaction_id=" + data.transaction_id;
                        window.location.replace(url);
                        $(".page-loader").hide();

                    } else if (data.status == 0) {

                        $(".page-loader").hide();

                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });

                    }
                }
            });


        }
    });


    $('input[name="method"]').click(function() {
        var selectedMethod = $('input[name="method"]:checked').val();
        // console.log(selectedMethod);
        $.ajax({
            url: base_url + "/get_fedex_rate",
            type: 'GET',
            data: {
                type:selectedMethod,
            },
            beforeSend: function() {
                $(".page-loader").show();
            },
            success: function(data) {
                if (data.status == 1) {
                    $("#step2").submit();
                    $(".page-loader").hide();
                }else if (data.status == 0) {

                    toastr.options = {
                        "closeButton": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.error(data.msg);

                    var radioButtons = document.querySelectorAll('input[name="method"]');
                    radioButtons.forEach(function(radioButton) {
                        radioButton.checked = false;
                    });

                    $(".page-loader").hide();

                }
            }
        });
    });




    $('#sameAddress').click(function() {
        // Checking if the checkbox is checked or not
        if ($(this).is(':checked')) {
            // $(".shippingAddr").slideUp();
            $('input[name="s_name"]').val($('input[name="name"]').val());
            $('input[name="s_address"]').val($('input[name="address"]').val());
            $('input[name="s_city"]').val($('input[name="city"]').val());
            $('input[name="s_state"]').val($('input[name="state"]').val());
            $('input[name="s_zipcode"]').val($('input[name="zipcode"]').val());

        } else {
            // $(".shippingAddr").slideDown();
            $('input[name="s_name"]').val("");
            $('input[name="s_address"]').val("");
            $('input[name="s_city"]').val("");
            $('input[name="s_state"]').val("");
            $('input[name="s_zipcode"]').val("");
        }
    });

    $('#createAccount').click(function() {
        // Checking if the checkbox is checked or not
        if ($(this).is(':checked')) {
            $(".PasswordSec").slideDown();
            $("#password_newaccount").attr("required","required");
        } else {
            $(".PasswordSec").slideUp();
            $("#password_newaccount").removeAttr("required");
        }
    });

    $("#user_changepassword").validate({
        ignore: [],
        rules: {
            "user_password": {
                required: true,
            },
            "confirm_user_password": {
                required: true,
                equalTo: "#user_password"
            },
        },
        messages: {
            "confirm_user_password": {
                equalTo: "Passwords do not match"
            }
        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#user_changepassword')[0];
            var formData = new FormData(form);
            event.preventDefault();

            console.log(formData);

            $.ajax({
                url: base_url + "/user_changepassword",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $(".page-loader").show();
                },
                success: function(data) {
                    if (data.status == 1) {

                        Swal.fire({
                            title: 'Success',
                            text: data.msg,
                            icon: 'success',
                        });

                        $(".page-loader").hide();
                        form.reset();

                    } else if (data.status == 0) {

                        $(".page-loader").hide();

                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });

                    }
                }
            });
        }
    });

    $("#forgotpasswordForm").validate({
        ignore: [],
        rules: {
            "user_email": {
                required: true,
            },

        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#forgotpasswordForm')[0];
            var formData = new FormData(form);
            event.preventDefault();

            console.log(formData);

            $.ajax({
                url: base_url + "/user_resetpassword",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $('#reset_btn').html('Please Wait...');
                    $('#reset_btn').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.status == 1) {

                        Swal.fire({
                            title: 'Success',
                            text: data.msg,
                            icon: 'success',
                        });

                        $('#reset_btn').html('Reset');
                        $("#reset_btn").prop("disabled", false);
                        form.reset();

                    } else if (data.status == 0) {

                        $('#reset_btn').html('Reset');
                        $("#reset_btn").prop("disabled", false);

                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });

                    }
                }
            });
        }
    });

    $(".isnumber").keydown(function(e) {
        -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || 65 == e.keyCode && (!0 === e.ctrlKey || !0 === e.metaKey) || 67 == e.keyCode && (!0 === e.ctrlKey || !0 === e.metaKey) || 88 == e.keyCode && (!0 === e.ctrlKey || !0 === e.metaKey) || e.keyCode >= 35 && e.keyCode <= 39 || (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.preventDefault()
    });
    //footer newslater
    $("#newslater_footer_frm").validate({
        ignore: [],
        rules: {

            "newslater_email": {
                required: true,
            }

        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#newslater_footer_frm')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url + "/store-newslater-email",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $('#footer_sign_up').html('Please Wait...');
                    $('#footer_sign_up').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.status == 1) {
                        $('#newslater_footer_frm')[0].reset();
                        Swal.fire({
                            // title: 'Success',
                            title: data.seccess_msgg,
                            text: data.msg,
                            icon: 'success',
                        });

                        $('#footer_sign_up').html('Sign up');
                        $("#footer_sign_up").prop("disabled", false);

                    } else if (data.status == 0) {
                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });
                        $('#footer_sign_up').html('Sign up');
                        $("#footer_sign_up").prop("disabled", false);
                    }
                }
            });
        }
    });
    //popup newslater
    $("#newslater_popup_frm").validate({
        ignore: [],
        rules: {

            "newslater_email": {
                required: true,
            }

        },
        messages: {

        },
        errorElement: 'span',
        submitHandler: function(form) {

            var form = $('#newslater_popup_frm')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url + "/store-newslater-email",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $('#sign_me_up').html('Please Wait...');
                    $('#sign_me_up').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.status == 1) {


                        $("#staticBackdrop .btn-close").click();

                        $('#newslater_popup_frm')[0].reset();



                        Swal.fire({
                            title: data.seccess_msgg,
                            text: data.msg,
                            icon: 'success',
                            // text: copy,
                        });

                        $('#sign_me_up').html('Sign up');
                        $("#sign_me_up").prop("disabled", false);

                    } else if (data.status == 0) {
                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'warning',
                        });
                        $('#sign_me_up').html('Sign up');
                        $("#sign_me_up").prop("disabled", false);
                    }
                }
            });
        }
    });

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.attributeBtn = function(attribute_items_id) {

    $.ajax({
        url: base_url + "/getattribute_items",
        type: 'get',
        data: {
            attribute_items_id: attribute_items_id
        },
        beforeSend: function() {

        },
        success: function(data) {
            if (data.status == 1) {
                $(".productPrice").html('$' + data.price);
                $("#hidden_attribute_items_id").val(attribute_items_id);

                $(".appendOverview").html(data.product_overview);

                $(".size_append").html(data.sname_attribute_html);
                $("#size_attribute").val(data.size_attribute);

                if (data.images != '') {

                    $(".outer").html(data.images);

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
                            navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
                        })
                        .on("changed.owl.carousel", syncPosition);

                    thumbs
                        .on("initialized.owl.carousel", function() {
                            thumbs.find(".owl-item").eq(0).addClass("current");
                        })
                        .owlCarousel({
                            items: 4,
                            dots: true,
                            nav: false,
                            navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
                            smartSpeed: 200,
                            slideSpeed: 500,
                            slideBy: 4,
                            responsiveRefreshRate: 100,
                        })
                        .on("changed.owl.carousel", syncPosition2);

                    thumbs.on("click", ".owl-item", function(e) {
                        e.preventDefault();
                        var number = $(this).index();
                        bigimage.data("owl.carousel").to(number, 300, true);
                    });

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
                        thumbs.find(".owl-item").removeClass("current").eq(current).addClass("current");
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
                }

            }
        }
    });

}

window.attributeBtn_name = function(size_attribute_name) {
    $("#size_attribute_name").val(size_attribute_name);
}


window.viewSpecification = function() {
    var hidden_attribute_items_id = $("#hidden_attribute_items_id").val();
    if (hidden_attribute_items_id == '') {
        $(".alertMsg").show();
        $(".alertMsg").html('Select Options Above');
    } else {
        $(".alertMsg").hide();

        const specificationsModal = document.getElementById('specificationsModal');
        const specificationsModals = new Modal(specificationsModal);

        var productName = $('.productName').text();

        $.ajax({
            url: base_url + "/viewSpecification",
            type: 'get',
            data: {
                attribute_items_id: hidden_attribute_items_id,
            },
            beforeSend: function() {

            },
            success: function(data) {
                if (data.status == 1) {
                    specificationsModals.show();
                    $(".specificationtitle").html(productName + ' ' + data.attribute_items_name);
                    $(".appendTable").html(data.html);
                }
            }
        });



    }
}

window.addtoCart = function(product_id, is_variation, type) {

    var product_title = $('.productName').text();
    var totalqty = $("#totalqty").val();

    var attribute_items_id = $("#hidden_attribute_items_id").val();
    var hidden_attribute_items_id = $("#hidden_attribute_items_id").val();
    var size_attribute = $("#size_attribute").val();
    var size_attribute_name = $("#size_attribute_name").val();

    

    
    var attribute_items_id = '';
    addtoCart_process(product_id, is_variation, hidden_attribute_items_id, totalqty, product_title, size_attribute_name, type);


}


window.addtoCart_process = function(product_id, is_variation, attribute_items_id, totalqty, product_title, size_attribute_name, type) {

    console.log(attribute_items_id);

    $.ajax({
        url: base_url + '/addtoCart',
        type: 'POST',
        data: {
            'product_id': product_id,
            'is_variation': is_variation,
            'attribute_items_id': attribute_items_id,
            'totalqty': totalqty,
            'product_title': product_title,
            'size_attribute_name':size_attribute_name,
            'type':type,
        },
        beforeSend: function() {},
        success: function(data) {
            if (data.status == 1) {
                $(".totalcart_item").html(data.totalcart_item);
                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success('Product successfully add in cart');
                if(type == 'buy'){
                    window.location.href = base_url + '/checkout';
                }
            } else if (data.status == 0) {
                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.error(data.msg);
            }
        }
    });

}

window.addremove = function(val) {
    var quantity = $("#totalqty").val();
    console.log(quantity);
    if (val == 'decrease') {
        if (quantity > 1) {
            var newquantity = (quantity - 1);
        }
    } else if (val == 'increase') {
        var newquantity = (parseInt(quantity) + 1);
    }
    $("#quantity").val(newquantity);
    $("#totalqty").val(newquantity);


}

window.showmodal = function() {
    const myModal = document.getElementById('staticBackdrop');
    const modal = new Modal(myModal);
    modal.show();
}


window.cartUpdate = function(cartitem, cartid, cartprice, updatetype) {
    $.ajax({
        url: base_url + '/cartupdate',
        type: 'POST',
        data: {
            'cartitem': cartitem,
            'cartid': cartid,
            'cartprice': cartprice,
            'updatetype': updatetype,
        },
        beforeSend: function() {
            $('.loading').attr("style", "display:block");
        },
        success: function(data) {
            $('.loading').attr("style", "display:none");
            var obj = JSON.parse(data);
            if (obj.status == 1) {
                $(".totalamount_" + cartid).html("$" + obj.newproductcartprice);
                $(".finaltotalprice").html("$" + obj.total);
                $(".totalcart_item").html(obj.totalcart_item);

            } else if (obj.status == 0) {
                Swal.fire({
                    title: 'Alert',
                    text: obj.msg,
                    icon: 'warning',
                });
            }
        }
    });
}



window.loginPopup = function(val) {
    const myModal = document.getElementById('logInModal');
    const modal = new Modal(myModal);
    modal.show();

    if (val == 'checkout') {
        $('.not-account').show();
    } else {
        $('.not-account').hide();
    }
}

window.remove_cart = function() {
    // alert();
    if (confirm("You want to remove item?")) {
        $("#remove_cart_frm").submit();
    }
}

window.checkCoupon = function() {
    var promocode = $("#promocode").val();

    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $.ajax({
        url: base_url + '/checkCoupon',
        type: 'POST',
        data: {
            'promocode': promocode,
        },
        beforeSend: function() {
            $(".page-loader").show();
        },
        success: function(data) {

            if(data.status == 1){
                $(".checkout_calculation_html").html(data.checkout_calculation_html);
                $(".page-loader").hide();
                toastr.success('Promo code apply successfully');

                var button = document.getElementById('applyCoupon');
                button.setAttribute('onclick', 'removeCoupon()');
                button.innerText = 'Remove';
                button.style.backgroundColor = '#f30909';
                button.style.color = '#ffffff';

                var inputField = document.getElementById('promocode');
                inputField.disabled = true;

            }else if(data.status == 0) {

                toastr.error(data.msg);
                $(".page-loader").hide();

            }
        }
    });


}

window.removeCoupon = function() {
    var promocode = '';

    $.ajax({
        url: base_url + '/removeCoupon',
        type: 'POST',
        data: {
            'promocode': promocode,
        },
        beforeSend: function() {
            if($("#promocode").val()!=''){
                $(".page-loader").show();
            }
        },
        success: function(data) {

            if(data.status == 1){
                $(".checkout_calculation_html").html(data.checkout_calculation_html);
                if($("#promocode").val()!=''){
                    $(".page-loader").hide();
                    toastr.success('Promo code remove successfully');

                    var button = document.getElementById('applyCoupon');
                    button.setAttribute('onclick', 'checkCoupon()');
                    button.innerText = 'Apply';
                    button.style.backgroundColor = '#11c7f7';
                    button.style.color = '#041541';

                    var inputField = document.getElementById('promocode');
                    inputField.disabled = false;
                    inputField.value = '';
                }

            }else if(data.status == 0) {

                toastr.error(data.msg);
                $(".page-loader").hide();

            }
        }
    });

}

window.getName = function(nameInput) {
    var nameValue = nameInput.value;
    var sNameInput = document.querySelector('[name="s_name"]');
    sNameInput.value = nameValue;
}
window.getaddress = function(nameInput) {
    var nameValue = nameInput.value;
    var sNameInput = document.querySelector('[name="s_address"]');
    sNameInput.value = nameValue;
}
window.getaCity = function(nameInput) {
    var nameValue = nameInput.value;
    var sNameInput = document.querySelector('[name="s_city"]');
    sNameInput.value = nameValue;
}
window.getastate = function(nameInput) {
    var nameValue = nameInput.value;
    var sNameInput = document.querySelector('[name="s_state"]');
    sNameInput.value = nameValue;
}
window.getzipcode = function(nameInput) {
    var nameValue = nameInput.value;
    var sNameInput = document.querySelector('[name="s_zipcode"]');
    sNameInput.value = nameValue;
}

window.backSteptwo = function(nameInput) {
    $("#step2").hide();
    $("#step1").show();

    $(".li_stape2").removeClass("is-active");
    $(".li_stape1").removeClass("is-done");
    $(".li_stape1").addClass("is-active");


    var radioButtons = document.querySelectorAll('input[name="method"]');
    radioButtons.forEach(function(radioButton) {
        radioButton.checked = false;
    });

}

window.backStepthree = function(nameInput) {
    $("#step3").hide();
    $("#step2").show();

    $(".li_stape3").removeClass("is-active");
    $(".li_stape2").removeClass("is-done");
    $(".li_stape2").addClass("is-active");

}

window.cancel_order = function(order_id) {
    $.ajax({
        url: base_url + '/cancel_order',
        type: 'POST',
        data: {
            'order_id': order_id,
        },
        beforeSend: function() {
            $(".page-loader").show();
        },
        success: function(data) {

            if(data.status == 1){
                location.reload();
                $(".page-loader").hide();
            }else if(data.status == 0) {

                toastr.error(data.msg);
                $(".page-loader").hide();

            }
        }
    });
}




