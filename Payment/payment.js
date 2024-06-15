
document.addEventListener('DOMContentLoaded', () => {
    const paymentSelect = document.getElementById('payment');
    const tngPopup = document.getElementById('method3');
    const closeTngButton = document.getElementById('closeTNG');
    const debitCardPopup = document.getElementById('method-debit-card');
    const closeDebitCardButton = document.getElementById('closeDebitCard');
    const creditCardPopup = document.getElementById('method-credit-card');
    const closeCreditCardButton = document.getElementById('closeCreditCard');

    paymentSelect.addEventListener('change', (event) => {
        // Reset all popups to hidden initially
        tngPopup.classList.remove('active');
        debitCardPopup.classList.remove('active');
        creditCardPopup.classList.remove('active');

        // Show the selected payment method popup
        if (event.target.value === 'Touch_N_Go') {
            tngPopup.classList.add('active');
        } else if (event.target.value === 'Debit_Card') {
            debitCardPopup.classList.add('active');
        } else if (event.target.value === 'Credit_Card') {
            creditCardPopup.classList.add('active');
        }

        // Store the selected payment method in a hidden input field
        document.getElementById('selected-payment-method').value = event.target.value;
    });

    closeTngButton.addEventListener('click', () => {
        tngPopup.classList.remove('active');
    });

    closeDebitCardButton.addEventListener('click', () => {
        debitCardPopup.classList.remove('active');
    });

    closeCreditCardButton.addEventListener('click', () => {
        creditCardPopup.classList.remove('active');
    });
});
