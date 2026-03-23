$(function() {
    $(document).on('click', '.menu-open', function() {
        $(this).closest(".menu-open").find(".sub-menu-list").slideToggle("slow");
    });

    // side menu close start
    $(document).on('click', '.side-menu-close', function() {
        $(this).toggleClass("closed");
        $(".sidebar").toggleClass("hide-sidenav");
    });

    /*-------------------------------------Password Eye-----------------------------------*/
    $(document).on('click', '.pass_eye', function() {
        if ($(this).closest('.add_eye').find(".pass_input").attr('type') == 'password') {
            $(this).closest('.add_eye').find(".pass_input").attr('type', 'text');
            $(this).closest('.add_eye').find(".fa-solid").addClass("fa-eye").removeClass("fa-eye-slash");
        } else {
            $(this).closest('.add_eye').find(".pass_input").attr('type', 'password');
            $(this).closest('.add_eye').find(".fa-solid").removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });

});
//Bootstrap 5 Validation

(function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    //Sweet Alert for delete data
    $(document).on("click", ".delete-item", function() {
        var url = $(this).data("url");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.isConfirmed) {
                window.location = url;
            }
        });
    });
})()