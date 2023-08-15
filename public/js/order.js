$(document).ready(function () {
    var orderStatus = document.querySelectorAll('.orderStatus');
    orderStatus.forEach((status) => {
        status.addEventListener('change', function (event) {
            event.preventDefault();
            var id = $(this).attr("data-id");
            var status = $(this).val();
            console.log(id, status);

            updateStatus(id, status);
        })
    })

    document.addEventListener('click', function (event) {
        // get current click element
        var currentClickElement = event.target;
        // Check if the click element is a select element
        if (!currentClickElement.classList.contains('orderStatus')) {
            orderStatus = document.querySelectorAll('.orderStatus');
            orderStatus.forEach((status) => {
                status.addEventListener('change', function (event) {
                    event.preventDefault();
                    var id = $(this).attr("data-id");
                    var status = $(this).val();
                    console.log(id, status);

                    updateStatus(id, status);
                })
            })
        }
    });

    function updateStatus(id, status) {
        $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
        $.ajax({
            url: "/api/orders/" + id,
            type: "PUT",
            data: { status: status },
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
    }
})

function orderReceived(id, status) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success me-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        'icon': 'question',
        'title': 'Are you sure to confirm this order?',
        'text': 'This order will be confirmed and cannot be reverted!',
        'showCancelButton': true,
        'confirmButtonText': 'Yes, confirm',
        'cancelButtonText': 'No, cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
            $.ajax({
                url: "/api/orders/" + id,
                type: "PUT",
                data: { status: status },
                success: function (response) {
                    $('.overlay').remove()
                    Swal.fire({
                        'icon': 'success',
                        'title': 'Update status successfully',
                        'showConfirmButton': false,
                        'timer': 2000
                    })

                    var el = document.getElementById('order_' + id)
                    $(el)
                        .closest('#order_' + id)
                        .css('background', '#f27474')
                        .closest('#order_' + id)
                        .fadeOut(800, function () {
                            $('#order_' + id).remove()
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
        }
    })
}
