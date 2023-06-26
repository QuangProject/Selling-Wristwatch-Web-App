const subTotal = document.getElementById('sub-total')
const shipping = document.getElementById('shipping')
const shippingPrice = document.getElementById('shipping-price')
const totalPrice = document.getElementById('total-price')

shipping.addEventListener('change', function () {
    const shippingValue = shipping.value
    const subTotalValue = subTotal.textContent
    shippingPrice.textContent = '$' + shippingValue
    const total = parseFloat(subTotalValue) + parseFloat(shippingValue)
    totalPrice.textContent = '$' + total
})

const btnPayment = document.getElementById('btn-payment');
btnPayment.addEventListener('click', () => {
});

const selectReceiver = document.getElementById('select-receiver');
selectReceiver.addEventListener('change', () => {
    const receiverValue = selectReceiver.value;
});