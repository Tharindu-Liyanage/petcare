//search table
var options = {
    valueNames: ['id-search', 'profile', 'date-search', 'diagnosis-search','followup-search', 'status-search', 'type-search', 'profile-three'],
    page: 5,
    pagination: true,
};

var userList = new List('medicalreport', options);



document.querySelector('.show-entries').addEventListener('change', function () {
  var selectedValue = parseInt(this.value);
  userList.page = selectedValue;
  userList.update();
});