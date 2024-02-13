// Function to attach click event listeners to "Add to Cart" links
function attachAddToCartListeners() {
    // Find all elements with class "cart-btn"
    var addToCartLinks = document.querySelectorAll('.cart-btn');

    // Attach click event listener to each "Add to Cart" link
    addToCartLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            var productId = this.getAttribute('data-product-id'); // Get product ID
            var quantity = 1; // You can allow users to choose quantity if needed

            // Send AJAX request to addToCart.php
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/petcare/shop/addToCart');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Handle success response
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        //  alert('Product added to cart!');
                        updateCartInfo();
                    } else {
                        //  alert('Failed to add product to cart.');
                    }
                } else {
                    // Handle other HTTP statuses
                    alert('Failed to add product to cart. Please try again later.');
                }
            };
            xhr.onerror = function() {
                // Handle network errors
                alert('Network error. Failed to add product to cart.');
            };
            xhr.send('productId=' + encodeURIComponent(productId) + '&quantity=' + encodeURIComponent(quantity));
        });
    });
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



// Check if cart info exists in local storage on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartInfo(); // Call updateCartInfo to populate the cart info on page load
    attachAddToCartListeners(); // Attach event listeners to "Add to Cart" links on page load
});
