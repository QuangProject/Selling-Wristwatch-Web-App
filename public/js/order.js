$(document).ready(function () {
    $(".orderStatus").change(function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        var status = $(this).val();
        $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
        $.ajax({
            url: "/api/orders/" + id,
            type: "PUT",
            data: { id: id, status: status },
            success: function (response) {
                $('.overlay').remove()
                Swal.fire({
                    'icon': 'success',
                    'title': 'Update status successfully',
                    'showConfirmButton': false,
                    'timer': 2000
                })
            },
            error: function (error) {
                $('.overlay').remove()
                console.log(error);
                if (error.status === 400) {
                    Swal.fire(
                        'Warning',
                        error.responseJSON.message,
                        'warning'
                    )
                }
                if (error.status === 500) {
                    Swal.fire(
                        'Error',
                        error.responseJSON.message,
                        'error'
                    )
                }
            }
        })
    })
})