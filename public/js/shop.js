// ADD TO CART AJAX
function addToCart(user_id, watch_id) {
    const cartCount = document.getElementById('cart-count');
    if (cartCount !== null) {
        const quantity = 1;
        $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
        // Send ajax request
        $.ajax({
            url: '/api/cart',
            type: 'POST',
            data: {
                user_id: user_id,
                watch_id: watch_id,
                quantity: quantity
            },
            success: function (response) {
                $('.overlay').remove()
                Swal.fire({
                    'icon': 'success',
                    'title': response.message,
                    'showConfirmButton': false,
                    'timer': 2000
                })

                if (response.cart.quantity == 1) {
                    let count = cartCount.textContent;
                    count++;
                    cartCount.textContent = count;
                }
            },
            error: function (error) {
                $('.overlay').remove()
                console.error(error);
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
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please login to add to cart!',
        })
    }
}