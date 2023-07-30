import $ from 'jquery';
global.$ = global.jQuery = $;
import './bootstrap';

// Handle delivery method change
function handleDeliveryMethodChange() {
    const $deliveryMethodCheckbox = $('#user_form_deliveryMethod');
    $('.delivery-fields').toggle($deliveryMethodCheckbox.prop('checked'));
}

// Handle payment method change
function handlePaymentMethodChange() {
    const $paymentMethodRadio = $('[name="user_form[paymentMethod]"]');
    const selectedPaymentMethod = $paymentMethodRadio.filter(':checked').val();
    $('.payment-fields').hide();

    if (selectedPaymentMethod === 'paypal') {
        $('.payment-fields.paypal-fields').show();
    } else if (selectedPaymentMethod === 'credit_card') {
        $('.payment-fields.credit-card-fields').show();
    }
}

// Initialize form changes
function initializeFormChanges() {
    const $deliveryMethodCheckbox = $('#user_form_deliveryMethod');
    const $paymentMethodRadio = $('[name="user_form[paymentMethod]"]');

    $deliveryMethodCheckbox.on('change', handleDeliveryMethodChange);
    $paymentMethodRadio.on('change', handlePaymentMethodChange);

    handleDeliveryMethodChange();
    handlePaymentMethodChange();
}

$(document).ready(function () {
    initializeFormChanges();

    // Handle creating a new account
    document.getElementById('createNewAccountCheckbox').addEventListener('change', function () {
        document.getElementById('userForm').style.display = this.checked ? 'block' : 'none';
    });

    // Handle different address checkbox
    const differentAddressCheckbox = document.getElementById('differentAddressCheckbox');
    const differentAddressForm = document.getElementById('differentAddressForm');
    differentAddressCheckbox.addEventListener('change', function () {
        differentAddressForm.style.display = this.checked ? 'block' : 'none';
    });

    // Validate city input
    const cityInput = document.getElementById('user_other_address_delivery_form_city');
    const cityErrorMessage = createErrorMessage();
    cityInput.addEventListener('input', function () {
        const cityValue = this.value.trim();
        cityErrorMessage.textContent = cityValue.length < 2 || cityValue.length > 100 ?
            'Miasto powinno zawierać od 2 do 100 znaków.' : '';
    });

    // Validate postal code input
    const postalCodeInput = document.getElementById('user_other_address_delivery_form_postalCode');
    const postalCodeErrorMessage = createErrorMessage();
    postalCodeInput.addEventListener('input', function () {
        const postalCodeValue = this.value.trim();
        postalCodeErrorMessage.textContent = /^\d{2}-\d{3}$/.test(postalCodeValue) ?
            '' : 'Kod pocztowy powinien mieć format XX-XXX.';
    });

    // Validate address input
    const addressInput = document.getElementById('user_other_address_delivery_form_address');
    const addressErrorMessage = createErrorMessage();
    addressInput.addEventListener('input', function () {
        const addressValue = this.value.trim();
        addressErrorMessage.textContent = addressValue.length < 5 ?
            'Adres powinien zawierać co najmniej 5 znaków.' : '';
    });

    // Fetch payment methods based on shipping method
    document.querySelectorAll('input[name="shippingMethod"]').forEach((radioButton) => {
        radioButton.addEventListener('change', function () {
            const shippingMethodId = this.value;
            fetch(`/get_payment_methods/${shippingMethodId}`)
                .then((response) => response.json())
                .then((data) => {
                    const paymentMethodsContainer = document.getElementById('paymentMethodsContainer');
                    paymentMethodsContainer.innerHTML = '';

                    if (data.paymentMethods.length > 0) {
                        data.paymentMethods.forEach((paymentMethod) => {
                            const input = document.createElement('input');
                            input.type = 'radio';
                            input.name = 'selectedPaymentMethod';
                            input.className = 'form-check-input';
                            input.value = paymentMethod;

                            const label = document.createElement('label');
                            label.textContent = paymentMethod;

                            const div = document.createElement('div');
                            div.className = 'form-check';
                            div.appendChild(input);
                            div.appendChild(label);

                            paymentMethodsContainer.appendChild(div);
                        });
                    } else {
                        const p = document.createElement('p');
                        p.textContent = 'Brak dostępnych metod płatności dla wybranej metody dostawy.';
                        paymentMethodsContainer.appendChild(p);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    });

    // Check discount code
    document.getElementById('checkDiscountCodeBtn').addEventListener('click', function () {
        const codeInput = document.getElementById('discount_code_form_code');
        const discountCode = codeInput.value;

        if (discountCode) {
            fetch(`/check_discount_code/${discountCode}`)
                .then((response) => response.json())
                .then((data) => {
                    const discountCodeMessage = document.getElementById('discountCodeMessage');
                    discountCodeMessage.textContent = data.message;
                    discountCodeMessage.style.display = 'block';

                    let totalOrderPriceElement = document.getElementById('totalOrderPrice');
                    let selectedShippingMethod = document.querySelector('input[name="shippingMethod"]:checked');
                    let shippingMethodText = selectedShippingMethod ? selectedShippingMethod.nextElementSibling.textContent.trim() : null;
                    let price = 0;
                    if (shippingMethodText) {
                        let priceRegex = /\d+\.\d+/;
                        let matches = shippingMethodText.match(priceRegex);
                        price = parseFloat(matches[0]);
                    }
                    if (data.isActive) {
                        let totalPriceWithDiscount = (totalOrderPriceWithoutDiscount * ((100 - data.discountPercentage)) / 100) + price;
                        totalOrderPriceElement.textContent = totalPriceWithDiscount.toFixed(2) + ' zł';
                    } else {
                        totalOrderPriceElement.textContent = totalOrderPriceWithoutDiscount + price + ' zł';
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    });

    // Handle adding discount code
    document.getElementById('addDiscountCodeBtn').addEventListener('click', function () {
        const discountCodeFormContainer = document.getElementById('discountCodeFormContainer');
        discountCodeFormContainer.style.display = discountCodeFormContainer.style.display === 'none' ? 'block' : 'none';
    });

    // Handle confirming the purchase
    document.getElementById('confirmPurchaseBtn').addEventListener('click', function () {
        const commentInput = document.getElementById('comment');
        const comment = commentInput.value;
        const newsletterCheckbox = document.getElementById('newsletterCheckbox');
        const regulationsCheckbox = document.getElementById('regulationsCheckbox');

        if (!regulationsCheckbox.checked) {
            alert('Checkbox "Zapoznałem się z Regulaminem" jest wymagany.');
            return;
        }

        const data = {
            comment: comment,
            totalPrice: totalOrderPriceWithoutDiscount,
            purchasedProducts: 'testowy produkt',
        };

        fetch('/place_order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((data) => {
                if (newsletterCheckbox.checked) {
                    const newsletterConfirmation = document.querySelector('.newsletter-confirmation');
                    newsletterConfirmation.style.display = 'block';
                }
                const orderConfirmation = document.querySelector('.order-confirmation');
                const orderNumberSpan = document.getElementById('orderNumber');
                orderNumberSpan.textContent = data.orderNumber;
                orderConfirmation.style.display = 'block';
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });
});

// Helper function to create error message element
function createErrorMessage() {
    const errorMessage = document.createElement('span');
    errorMessage.classList.add('error-message');
    return errorMessage;
}

document.addEventListener('DOMContentLoaded', function() {
    let totalOrderPriceElement = document.getElementById('totalOrderPrice');
    let totalPrice = totalOrderPriceWithoutDiscount;

    totalOrderPriceElement.innerText = totalPrice + ' zł';
});

