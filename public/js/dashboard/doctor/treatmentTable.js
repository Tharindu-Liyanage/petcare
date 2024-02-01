// Get references to the elements
const deleteLinks = document.querySelectorAll(".removeLink"); // Select all delete links
const notification = document.getElementById("removeModel");
const confirmDeleteButton = document.getElementById("confirmDelete");
const cancelDeleteButton = document.getElementById("cancelDelete");


//search table

 

  var options = {
      valueNames: ['id-search', 'profile', 'visit-date-search', 'diagnosis-search', 'species-search', 'followup-search','status-search'],
      page: 5,
      pagination: true,
  };

  var userList = new List('treatment', options);
  


  document.querySelector('.show-entries').addEventListener('change', function () {
    var selectedValue = parseInt(this.value);
    userList.page = selectedValue;
    userList.update();
});
  


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
