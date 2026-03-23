$(function() {
    "use strict";

    $("#changepasswordform").validate({

        rules : {
            password : {
                required : true,
                minlength: 6,
            },
            confirm_password : {
                required : true,
                minlength: 6,
                equalTo: "#password",
            },
        },
       messages : {

       },
       errorElement : 'span',
       submitHandler: function(form) {
            e.preventDefault();
            $("#changepasswordform").submit();
        }
    });

    $("#categoryForm").validate({

        rules : {
            category_title : {
                required : true,
            },
            category_image : {
                extension: "jpg|jpeg|png",
                maxsize: 500000,
                required : true,
            },
        },
       messages : {

       },
       errorElement : 'span',
       submitHandler: function(form) {
            e.preventDefault();
            $("#categoryForm").submit();
        }
    });


    $("#typeForm").validate({

        rules : {
            typename : {
                required : true,
            },
            category_id : {
                required : true,
            },
            category_image : {
                extension: "jpg|jpeg|png|webp",
                maxsize: 500000,
            },
        },
       messages : {

       },
       errorElement : 'span',
       submitHandler: function(form) {
            e.preventDefault();
            $("#typeForm").submit();
        }
    });

    $("#brandForm").validate({

        rules : {
            brandname : {
                required : true,
            },
            brandimage : {
                extension: "jpg|jpeg|png",
                maxsize: 500000,
            },
        },
       messages : {

       },
       errorElement : 'span',
       submitHandler: function(form) {
            e.preventDefault();
            $("#brandForm").submit();
        }
    });


    $("#createProductform").validate({
        ignore: [],
        rules : {
            "product_img[]" : {
                extension: "jpg|jpeg|png",
                maxsize: 500000,
            },
            "size_variants[]" : {
                required : true,
            },

       },
       messages : {
        "product_img[]" : {
            maxsize: "File size must be less than 500 KB.",
        },
       },
       errorElement : 'span',
       submitHandler: function(form) {

            var form = $('#createProductform')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url+"/admin/save_product",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend:function(){
                  $('#categoryBtn').html('Please Wait...');
                  $('#categoryBtn').attr('disabled','disabled');
                },
                success: function(data){
                    var obj=JSON.parse(data);
                    printErrorMsg(obj.error);
                    if(obj.status==1){
                        Swal.fire({
                            title: 'Success',
                            text: obj.msg,
                            icon: 'success',
                        });
                        window.location.href = base_url+"/admin/product-list";
                    }else if(obj.status==0){
                        Swal.fire({
                            title: 'Error',
                            text: obj.msg,
                            icon: 'warning',
                        });
                        $('#categoryBtn').html('Submit');
                        $("#categoryBtn").prop("disabled", false);
                    }
                }
            });
        }
       });

    $("#updateProductform").validate({
        ignore: [],
        rules : {
            "product_img[]" : {
                extension: "jpg|jpeg|png",
                maxsize: 500000,
            },
            "size_variants[]" : {
                required : true,
            },

       },
       messages : {
        "product_img[]" : {
            maxsize: "File size must be less than 500 KB.",
        },
       },
       errorElement : 'span',
       submitHandler: function(form) {

            var form = $('#updateProductform')[0];
            var formData = new FormData(form);
            event.preventDefault();

            $.ajax({
                url: base_url+"/admin/update_product",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend:function(){
                  $('#categoryBtn').html('Please Wait...');
                  $('#categoryBtn').attr('disabled','disabled');
                },
                success: function(data){
                    var obj=JSON.parse(data);
                    printErrorMsg(obj.error);
                    if(obj.status==1){
                        Swal.fire({
                            title: 'Success',
                            text: obj.msg,
                            icon: 'success',
                        });
                        window.location.href = base_url+"/admin/product-list";
                    }else if(obj.status==0){
                        Swal.fire({
                            title: 'Error',
                            text: obj.msg,
                            icon: 'warning',
                        });
                        $('#categoryBtn').html('Submit');
                        $("#categoryBtn").prop("disabled", false);
                    }
                }
            });
        }
    });

    $("#settingForm").validate({

        rules : {

            site_logo : {
                extension: "jpg|jpeg|png|webp",
                maxsize: 500000,
            },
        },
       messages : {

       },
       errorElement : 'span',
       submitHandler: function(form) {
            e.preventDefault();
            $("#settingForm").submit();
        }
    });

    $("#CouponForm").validate({

        rules : {
        },
       messages : {
       },
       errorElement : 'span',
       submitHandler: function(form) {
            e.preventDefault();
            $("#CouponForm").submit();
        }
    });


    $('#product_desc').summernote({
        height: 400,
        // callbacks: {
        //     onImageUpload: function(image) {
        //         uploadImage(image[0]);
        //     }
        // }
    });
    $('#solutions').summernote({
        height: 300,
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            }
        }
    });



    $('#blogdesc').summernote({
        height: 500,
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            }
        }
    });

    $('.product_overview').summernote({
        height: 100,
    });

    $('.select2').select2();

    $(".isnumber").keydown(function(e) {
        -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || 65 == e.keyCode && (!0 === e.ctrlKey || !0 === e.metaKey) || 67 == e.keyCode && (!0 === e.ctrlKey || !0 === e.metaKey) || 88 == e.keyCode && (!0 === e.ctrlKey || !0 === e.metaKey) || e.keyCode >= 35 && e.keyCode <= 39 || (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.preventDefault()
    });


    // $('#product_offerprice').on('input', function() {
    //     var price = parseFloat($('#product_price').val());
    //     var offerPrice = parseFloat($(this).val());

    //     if (offerPrice >= price) {
    //         $(this).addClass('error');
    //         $('#error_message').text('Discount Price should not be equal or greater than original Price');
    //     } else {
    //         $(this).removeClass('error');
    //         $('#error_message').text('');
    //     }
    // });

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.printErrorMsg = function(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}

window.editblogCategory = function(id, title) {
    $("#title").val(title);
    $("#id").val(id);
    $("#categoryBtn").html('Update Category');
}

window.editbrand = function(id, title) {
    $("#brandname").val(title);
    $("#id").val(id);
    $("#categoryBtn").html('Update Brand');
    $("#brandimage").removeAttr('required');
}

window.checkStatusproductcategory = function(part_id, value) {

    if($("#packId_"+part_id).is(":checked")) {
        var value = 1;
    }else{
        var value = 0;
    }
        $.ajax({
                url: base_url+"/admin/productcategory_status",
                type: 'POST',
                data: {'part_id':part_id, value:value},
                beforeSend:function(){
                },
                success: function(data){
                    var obj=JSON.parse(data);
                    if(obj.status==1){
                        Swal.fire({
                            title: 'Success',
                            text: obj.msg,
                            icon: 'success',
                        });


                    }else if(obj.status==0){
                        Swal.fire({
                            title: 'Error',
                            text: obj.msg,
                            icon: 'warning',
                        });
                    }
                }
        });

}



window.uploadImage = function(image) {
    var data = new FormData();
    data.append("imagefile", image);
    $.ajax({
        url: base_url+"/admin/summernoteInagesave",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
            var image = $('<img>').attr('src', url);
            console.log(url);
            $('#blogdesc').summernote("insertNode", image[0]);
        },
        error: function(data) {
            console.log(data);
        }
    });
}

window.getType = function(categort_id) {

    console.log(categort_id);

    $.ajax({
        url: base_url+"/admin/getType",
        type: 'POST',
        data: {'categort_id':categort_id},
        beforeSend:function(){
        },
        success: function(data){
            $("#type_id").html(data);
        }
    });
}











