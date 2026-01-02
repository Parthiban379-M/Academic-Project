function validateForm() {
    var quantities = document.querySelectorAll('[id^="quantity"]');
    var selected = false;

    for (var i = 0; i < quantities.length; i++) {
        if (parseInt(quantities[i].value) > 0) {
            selected = true;
            break;
        }
    }

    if (!selected) {
        alert("Please select at least one product before proceeding to checkout.");
        return false; // Prevent form submission
     }

    return true; // Allow form submission
   }
    function decrementQuantity(quantityId, pricePerUnit) {
        var quantityInput = document.getElementById(quantityId);
        var quantity = parseInt(quantityInput.value);
        if (quantity > 0) {
            quantityInput.value = quantity - 1;
            calculateTotal(quantityId, 'total' + quantityId.charAt(quantityId.length - 1), pricePerUnit);
        }
    }

    function incrementQuantity(quantityId, pricePerUnit) {
        var quantityInput = document.getElementById(quantityId);
        var quantity = parseInt(quantityInput.value);
        quantityInput.value = quantity + 1;
        calculateTotal(quantityId, 'total' + quantityId.charAt(quantityId.length - 1), pricePerUnit);
    }

    function calculateTotal(quantityId, totalId, pricePerUnit) {
        var quantity = document.getElementById(quantityId).value;
        var total = quantity * pricePerUnit;
        document.getElementById(totalId).innerText = 'Rs.' + total;
        document.getElementById('hiddenTotal' + quantityId.charAt(quantityId.length - 1)).value = total; // Set hidden input field value

        if (quantity == 0) {
            // If quantity is 0, remove the corresponding product from form submission
            document.querySelector('input[name="name' + quantityId.charAt(quantityId.length - 1) + '"]').removeAttribute('name');
            document.querySelector('input[name="price' + quantityId.charAt(quantityId.length - 1) + '"]').removeAttribute('name');
            document.querySelector('input[name="hiddenTotal' + quantityId.charAt(quantityId.length - 1) + '"]').removeAttribute('name');
        }

        calculateNetTotal();
        // Store product information in session storage
        sessionStorage.setItem('productName' + quantityId.charAt(quantityId.length - 1), document.querySelector('input[name="name' + quantityId.charAt(quantityId.length - 1) + '"]').value);
        sessionStorage.setItem('productPrice' + quantityId.charAt(quantityId.length - 1), pricePerUnit);
        sessionStorage.setItem('productTotal' + quantityId.charAt(quantityId.length - 1), total);
    }

    function calculateNetTotal() {
        var totals = document.querySelectorAll('[id^="total"]');
        var netTotal = 0;
        for (var i = 0; i < totals.length; i++) {
            netTotal += parseInt(totals[i].innerText.replace('Rs.', ''));
        }
        document.getElementById('netTotalCell').innerText = 'Rs.' + netTotal;
        document.getElementById('HiddennetTotal').value = netTotal; // Set the value of hidden input field
        // Store net total in session storage
        sessionStorage.setItem('netTotal', netTotal);
    } 