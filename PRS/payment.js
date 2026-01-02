document.addEventListener("DOMContentLoaded", function () {
    const paymentOptions = document.querySelectorAll('.icon-radio');
    const cardDetails = document.querySelectorAll('.card-details');
    const upiDetails = document.querySelector('.upi-details');
    const cardTypeRadios = document.querySelectorAll('input[name="card_type"]');
    const cardNameInput = document.getElementById('card_name');
    const cardCVVInput = document.getElementById('card_cvv');
    const cardExpiryInput = document.getElementById('card_expiry');
    const cardNumberInput = document.getElementById('card_number');
    const upiNameInput = document.getElementById('upi_name');
    const upiIdInput = document.getElementById('upi_id');
    const cashCheckbox = document.getElementById('accept_cash');
    const submitBtn = document.querySelector('.submit-btn');
  
    // Function to validate the form before submission
    function validateForm() {
      const selectedPaymentOption = document.querySelector('input[name="payment_method"]:checked');
  
      if (selectedPaymentOption && selectedPaymentOption.value === 'cash') {
        // If cash on delivery is selected, check if the cash checkbox is checked
        if (!cashCheckbox.checked) {
          alert('Please accept cash on delivery by checking the checkbox.');
          return false;
        }
      } else if (selectedPaymentOption && selectedPaymentOption.value === 'card') {
        // If card payment is selected, check if all card details are filled
        if (!cardNameInput.value || !cardCVVInput.value || !cardExpiryInput.value || !cardNumberInput.value) {
          alert('Please fill in all card details.');
          return false;
        }
      } else if (selectedPaymentOption && selectedPaymentOption.value === 'net_banking') {
        // If netbanking (GPay) is selected, check if all UPI details are filled
        if (!upiNameInput.value || !upiIdInput.value) {
          alert('Please fill in all UPI details.');
          return false;
        }
      } else {
        // If no payment method is selected
        alert('Please select a payment method.');
        return false;
      }
  
      // If all validations pass, allow form submission
      return true;
    }
  
    paymentOptions.forEach(option => {
      option.addEventListener('click', () => {
        if (option.id === 'cash') {
          cardDetails.forEach(card => card.style.display = 'none');
          upiDetails.style.display = 'none';
          cardDetails.forEach(card => card.querySelectorAll('input[type="text"]').forEach(input => input.value = '')); // Clear card details
          upiDetails.querySelectorAll('input[type="text"]').forEach(input => input.value = ''); // Clear UPI details
          cashCheckbox.checked = false; // Uncheck cash checkbox
          // Disable card inputs
          cardNameInput.disabled = true;
          cardCVVInput.disabled = true;
          cardExpiryInput.disabled = true;
          cardNumberInput.disabled = true;
          // Disable card type radios
          cardTypeRadios.forEach(radio => radio.disabled = true);
          // Disable UPI inputs
          upiNameInput.disabled = true;
          upiIdInput.disabled = true;
        } else if (option.id === 'net_banking') {
          cardDetails.forEach(card => card.style.display = 'none');
          upiDetails.style.display = 'block';
          cardDetails.forEach(card => card.querySelectorAll('input[type="text"]').forEach(input => input.value = '')); // Clear card details
          upiDetails.querySelectorAll('input[type="text"]').forEach(input => input.value = ''); // Clear UPI details
          cashCheckbox.checked = false; // Uncheck cash checkbox
          // Enable UPI inputs
          upiNameInput.disabled = false;
          upiIdInput.disabled = false;
          // Disable card inputs
          cardNameInput.disabled = true;
          cardCVVInput.disabled = true;
          cardExpiryInput.disabled = true;
          cardNumberInput.disabled = true;
          // Disable card type radios
          cardTypeRadios.forEach(radio => radio.disabled = true);
        } else {
          cardDetails.forEach(card => card.style.display = 'block');
          upiDetails.style.display = 'none';
          upiDetails.querySelectorAll('input[type="text"]').forEach(input => input.value = ''); // Clear UPI details
          // Enable card inputs
          cardNameInput.disabled = false;
          cardCVVInput.disabled = false;
          cardExpiryInput.disabled = false;
          cardNumberInput.disabled = false;
          // Enable card type radios
          cardTypeRadios.forEach(radio => radio.disabled = false);
          // Disable UPI inputs
          upiNameInput.disabled = true;
          upiIdInput.disabled = true;
        }
      });
    });
  
    // Add event listener for form submission
    submitBtn.addEventListener('click', function (event) {
      if (validateForm()) {
        const selectedPaymentOption = document.querySelector('input[name="payment_method"]:checked');
        if (selectedPaymentOption && (selectedPaymentOption.value === 'card' || selectedPaymentOption.value === 'net_banking')) {
          alert('Payment successful!');
        }
      } else {
        event.preventDefault(); // Prevent form submission if validation fails
      }
    });
  });