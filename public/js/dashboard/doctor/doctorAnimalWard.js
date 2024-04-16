var showEntriesDropdown = document.querySelector('.show-entries');
var showEntriesDropdown2 = document.querySelector('.show-entries-2');
//search table

var options = {
    valueNames: ['id-search', 'profile', 'profile-three','cage-no', 'reason-search', 'date-search'],
    page: 5,
    pagination: true,
};

var userList = new List('admit', options);

var dischargeList = new List('discharge', options);

if (showEntriesDropdown) {
  showEntriesDropdown.addEventListener('change', function () {
      var selectedValue = parseInt(this.value);
      userList.page = selectedValue;
      userList.update();
  });
}

if (showEntriesDropdown2) {
    showEntriesDropdown2.addEventListener('change', function () {
        var selectedValue = parseInt(this.value);
        dischargeList.page = selectedValue;
        dischargeList.update();
    });
  }