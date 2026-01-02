function validateForm() {
    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;
    var address = document.getElementById("address").value;
    var todayDelivery = document.getElementById("todayDelivery").checked;

    var nameRegex = /^[a-zA-Z\s]*$/;
    var phoneRegex = /^\d{10}$/;
    var addressRegex = /^[a-zA-Z0-9\s]*$/; 

    // Validate name format
    if (!name.match(nameRegex)) {
        document.getElementById("nameError").innerText = "Name must contain only letters and spaces.";
        return false;
    } else {
        document.getElementById("nameError").innerText = "";
    }

    if (!phone.match(phoneRegex)) {
        document.getElementById("phoneError").innerText = "Phone number must be 10 digits.";
        return false;
    } else {
        document.getElementById("phoneError").innerText = "";
    }

    if (!address.match(addressRegex)) {
        document.getElementById("addressError").innerText = "Address cannot contain special characters.";
        return false;
    } else {
        document.getElementById("addressError").innerText = "";
    }
    if (!todayDelivery) {
        alert("Please accept delivery for today.");
        return false;
    }
    return true;
    }
    function validateForm() {
    var today = new Date();
    var deliveryDate = new Date(document.getElementById("deliveryDate").value);

    if (deliveryDate <= today) {
        document.getElementById("deliveryDateError").innerText = "Delivery date must be after today.";
        return false;
    } else {
        document.getElementById("deliveryDateError").innerText = "";
        return confirm("Are you sure you want to confirm your order?");
    }
}