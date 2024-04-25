
// Get references to the elements
const deleteLinks = document.querySelectorAll(".removeLink"); // Select all delete links
const notification = document.getElementById("removeModel");
const confirmDeleteButton = document.getElementById("confirmDelete");
const cancelDeleteButton = document.getElementById("cancelDelete");
var showEntriesDropdown = document.querySelector('.show-entries');

const shipmentStatusSelect = document.getElementById("ship-status");


//search table

 

  var options = {
      valueNames: ['invoice-id', 'profile', 'order-date', 'total', 'shipment-status'],
      page: 5,
      pagination: true,
  };

  var userList = new List('orders', options);
  


  if (showEntriesDropdown) {
    showEntriesDropdown.addEventListener('change', function () {
        var selectedValue = parseInt(this.value);
        userList.page = selectedValue;
        userList.update();
    });
  }
  


//paginantion







// Add click event listener to each delete link
deleteLinks.forEach((deleteLink) => {
  deleteLink.addEventListener("click", function (e) {
    // Block the default link behavior
    e.preventDefault();

    // Open the confirmation modal
    notification.style.display = "block";
    // Set the confirmation button's href to the delete URL
    confirmDeleteButton.setAttribute("href", this.getAttribute("href"));
    confirmDeleteButton.addEventListener("click", function () {
        window.location.href = this.getAttribute("href");
        
    });
    
    
  });
});

// Add click event listener to the "No" button to hide the notification
cancelDeleteButton.addEventListener("click", function () {
  notification.style.display = "none";
});


// shipmentStatusSelect.addEventListener("change", function() {
//   // Get the selected value
//   const selectedValue = this.value;

//   // Make an AJAX request to update the database
 
//   const data = { orderId: orderId, shipmentStatus: selectedValue };

//   fetch(url, {
//       method: "POST",
//       headers: {
//           "Content-Type": "application/json",
//       },
//       body: JSON.stringify(data),
//   })
//   .then(response => {
//       if (response.ok) {
//           console.log("Shipment status updated successfully");
//       } else {
//           console.error("Failed to update shipment status");
//       }
//   })
//   .catch(error => {
//       console.error("Error:", error);
//   });
// });


// function updateTable(invoiceId) {
  
//   // const selectedValue = document.getElementsByClassName('shipment-status')[Number(2)*Number(invoiceId)].value;
//   // console.log("invoiceId:"+ invoiceId, " shipmentStatus:"+ selectedValue);

//   const selectedValue = document.getElementById('ship-status').value;
//   console.log("invoiceId:" + invoiceId, " shipmentStatus:" + selectedValue);

//   $.ajax({
//       method: 'POST',
//       url: 'http://localhost/petcare/StoreManager/updateShipmentStatus',
//       data: { invoiceId: invoiceId, shipmentStatus: selectedValue },
//       success: function (response) {
//           console.log('Response:', response);
//           // Handle success response, if needed
//       },
//       error: function (error) {
//           console.error('Error:', error);
//           // Handle error response, if needed
//           console.log(data);
//       }
//   });
// }


  // Attach event listener to a common parent element
  document.addEventListener('change', function(event) {
      // Check if the change event occurred on a dropdown with class 'shipment-status'
      if (event.target.classList.contains('shipment-status')) {
          const selectedValue = event.target.value; // Get the selected value
          const invoiceId = event.target.dataset.invoiceId; // Get the invoice ID from data attribute
          console.log("invoiceId:" + invoiceId, " shipmentStatus:" + selectedValue);
          
          // Make an AJAX request to update the shipment status
          $.ajax({
              method: 'POST',
              url: 'http://localhost/petcare/StoreManager/updateShipmentStatus',
              data: { invoiceId: invoiceId, shipmentStatus: selectedValue },
              success: function (response) {
                  console.log('Response:', response);
                  // Handle success response, if needed
              },
              error: function (error) {
                  console.error('Error:', error);
                  // Handle error response, if needed
              }
          });
      }
  });





