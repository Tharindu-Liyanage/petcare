var showEntriesDropdown = document.querySelector('.show-entries');

//search table
var options = {
    valueNames: ['id-search', 'profile', 'diagnosis-search','followup-search', 'status-search', 'lastupdate-search', 'profile-three'],
    page: 5,
    pagination: true,
};

var userList = new List('medicalreport', options);



if (showEntriesDropdown) {
  showEntriesDropdown.addEventListener('change', function () {
      var selectedValue = parseInt(this.value);
      userList.page = selectedValue;
      userList.update();
  });
}