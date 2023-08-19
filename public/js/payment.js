var format = /[!@#$%^&*()_+\=\[\]{};':"\\|<>\/?]+/;
var phone_pattern = /^(\(0\d{1,3}\)\d{7})|(0\d{9})$/;

const subTotal = document.getElementById('sub-total')
const shipping = document.getElementById('shipping')
const shippingPrice = document.getElementById('shipping-price')
const shippingFeeStripe = document.getElementById('shipping-fee-stripe')
const totalPrice = document.getElementById('total-price')
const amount = document.getElementById('amount')

shipping.addEventListener('change', function () {
    const shippingValue = shipping.value
    const subTotalValue = subTotal.textContent
    shippingPrice.textContent = '$' + shippingValue
    shippingFeeStripe.value = shippingValue
    const total = parseFloat(subTotalValue) + parseFloat(shippingValue)
    totalPrice.textContent = total
    amount.value = total
})

// Get input
const inputFirstName = document.getElementById('first-name');
const inputLastName = document.getElementById('last-name');
const inputTelephone = document.getElementById('telephone');
const inputAddress = document.getElementById('address');
const selectReceiver = document.getElementById('select-receiver');

selectReceiver.addEventListener('change', () => {
    const receiverValue = selectReceiver.value;
    if (receiverValue == 0) {
        // Clear input
        inputFirstName.value = '';
        inputLastName.value = '';
        inputTelephone.value = '';
        inputAddress.value = '';
        return;
    }
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/receivers/' + receiverValue,
        method: 'GET',
        success: function (response) {
            inputFirstName.value = response.receiver.first_name;
            inputLastName.value = response.receiver.last_name;
            inputTelephone.value = response.receiver.telephone;
            inputAddress.value = response.receiver.sub_address + ', ' + response.receiver.address;
            $('.overlay').remove()
        },
        error: function (error) {
            console.log(error);
            $('.overlay').remove()
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
});

const errorPayment = document.getElementById('error-payment');
const btnPayment = document.getElementById('btn-payment');
btnPayment.addEventListener('click', (e) => {
    if (selectReceiver.value == 0) {
        errorPayment.textContent = 'Please select receiver';
        return;
    }
    errorPayment.textContent = '';
    const data = {
        receiver_id: selectReceiver.value,
        shipping_fee: shipping.value,
        total_price: totalPrice.textContent,
    }
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/orders',
        method: 'POST',
        data: data,
        success: function (response) {
            $('.overlay').remove()
            const userId = btnPayment.getAttribute('data-user-id');
            const order_id = response.order.id;
            const dataOrderDetail = {
                user_id: userId,
                order_id: order_id,
            }
            $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
            $.ajax({
                url: '/api/order-details',
                method: 'POST',
                data: dataOrderDetail,
                success: function (response) {
                    $('.overlay').remove()
                    Swal.fire(
                        'Success',
                        'Payment success',
                        'success'
                    ).then(() => {
                        window.location.href = '/user/cart';
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
            });
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
    });
});
