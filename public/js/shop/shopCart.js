// Define quantityInputs globally
var quantityInputs;

document.addEventListener('DOMContentLoaded', function() {
    // Select quantity input fields globally
    quantityInputs = document.querySelectorAll('.quantity input'); // Select only the input elements with class 'quantity'

    updateTotal(); // Call updateTotal to calculate total price on page load

    // Attach event listener to remove buttons
    var removeButtons = document.querySelectorAll('.remove button');
    removeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var productItem = this.closest('li'); // Find the closest <li> parent element
            var productId = productItem.querySelector('.quantity input').getAttribute('data-product-id'); // Get the product ID
            var quantityInput = productItem.querySelector('.quantity input'); // Find the quantity input in the product item
            var quantity = parseInt(quantityInput.value); // Get the quantity
            var price = parseFloat(quantityInput.getAttribute('data-product-price')); // Get the price
            var subtotal = quantity * price; // Calculate the subtotal of the removed item

            // Send AJAX request to remove the product from the server-side session
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/petcare/shop/removeFromCart');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Update the total price after removing the product
                    productItem.remove(); // Remove the product item from the list
                    updateCartInfo();
                    updateTotal(-subtotal); // Update the total price after removing the product
                    
                } else {
                    // Handle errors if needed
                    console.error('Failed to remove product from cart.');
                }
            };
            xhr.onerror = function() {
                // Handle network errors
                console.error('Network error. Failed to remove product from cart.');
            };
            xhr.send('productId=' + encodeURIComponent(productId));
        });
    });

    // Attach event listener to quantity input fields
    quantityInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            var productId = this.getAttribute('data-product-id'); // Get the product ID
            var newQuantity = parseInt(this.value); // Get the new quantity
            // Send AJAX request to update the quantity in the server-side session
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/petcare/shop/updateCartQuantity');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Update the total price after updating the quantity
                    updateTotal();
                    updateCartInfo();
                } else {
                    // Handle errors if needed
                    console.error('Failed to update quantity in cart.');
                }
            };
            xhr.onerror = function() {
                // Handle network errors
                console.error('Network error. Failed to update quantity in cart.');
            };
            xhr.send('productId=' + encodeURIComponent(productId) + '&quantity=' + encodeURIComponent(newQuantity));
        });
    });
});

function updateTotal(change = 0) {  //this function not working
    var total = 0;
    if (quantityInputs) { // Ensure quantityInputs is defined before using it
        quantityInputs.forEach(function(input) {
            var quantity = parseInt(input.value);
            var price = parseFloat(input.getAttribute('data-product-price'));
            total += quantity * price;
        });
    }
   
    console.log('change',change);
    
    total += change; // Add the change to the total (change can be negative if removing an item)
    console.log('total',total);
   // document.getElementById('total').textContent = 'LKR ' + total.toFixed(2);
}

// Update cart info
function updateCartInfo() {
    // Send AJAX request to fetch cart information from the server
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/petcare/shop/updateCartInfo');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Parse the JSON response
            var cartInfo = JSON.parse(xhr.responseText);

            // Update the cart total and item number in the HTML
            document.querySelector('.cart-total').textContent = 'LKR ' + cartInfo.total.toFixed(2);
            document.querySelector('.item-number').textContent = cartInfo.itemCount;
            document.getElementById('total').textContent = 'LKR ' + cartInfo.total.toFixed(2);

            // Store cart info in local storage
            localStorage.setItem('cartInfo', JSON.stringify(cartInfo));
        } else {
            // Handle other HTTP statuses
            console.error('Failed to fetch cart information.');
        }
    };
    xhr.onerror = function() {
        // Handle network errors
        console.error('Network error. Failed to fetch cart information.');
    };
    xhr.send();
}
