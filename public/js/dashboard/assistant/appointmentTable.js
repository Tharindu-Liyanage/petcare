// Get references to the elements
const deleteLinks = document.querySelectorAll(".rejectLink"); // Select all delete links
const notification = document.getElementById("removeModel");
const confirmDeleteButton = document.getElementById("confirmDelete");
const cancelDeleteButton = document.getElementById("cancelDelete");
var showEntriesDropdown = document.querySelector('.show-entries');
// Get the reason input element
const reasonInput = document.getElementById("reason");


//search table

 

  var options = {
      valueNames: ['id-search', 'profile-search', 'date-search', 'time-search', 'species-search', 'treatment-search', 'type-search', 'status-search', 'profile', 'profile-three','profile-three vet-search' ],
      page: 5,
      pagination: true,
  };

  var userList = new List('appointment', options);
  


   if (showEntriesDropdown) {
     showEntriesDropdown.addEventListener('change', function () {
        var selectedValue = parseInt(this.value);
       userList.page = selectedValue;
         userList.update();
    });
   }
  


//paginantion




// Add click event listener to the "No" button to hide the notification
cancelDeleteButton.addEventListener("click", function () {
  notification.style.display = "none";
});

// Add click event listener to each delete link
deleteLinks.forEach((deleteLink) => {
  deleteLink.addEventListener("click", function (e) {
    // Block the default link behavior
    e.preventDefault();

    // Open the confirmation modal
    notification.style.display = "block";

    // Set default border color for the reason input
    reasonInput.style.borderColor = "";

    // Get the URL from the delete link
    const deleteUrl = deleteLink.getAttribute("href");

    // Add click event listener to the confirmDeleteButton
    confirmDeleteButton.onclick = function () {
      // Get the reason input value and trim leading/trailing spaces
      const reasonValue = reasonInput.value.trim();

      // Check if a reason is provided
      if (reasonValue !== "") {
        // Format the reason to replace spaces with dashes
        const formattedReason = reasonValue.replace(/\s+/g, "-");

        // Construct the URL with the formatted reason
        const urlWithReason = `${deleteUrl}/${formattedReason}`;

        // Redirect to the URL with the reason
        window.location.href = urlWithReason;
      } else {
        // If no reason provided, set border color red to reason input
        reasonInput.style.borderColor = "red";
      }
    };
  });
});