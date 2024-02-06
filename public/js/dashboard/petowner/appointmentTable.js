var showEntriesDropdown = document.querySelector('.show-entries');

//search table

var options = {
    valueNames: ['id-search', 'profile', 'date-search', 'time-search', 'species-search', 'type-search','treatment-search', 'profile-three' , 'status-search', {data : ['date']}],
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

