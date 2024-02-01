//search table

var options = {
    valueNames: ['id-search', 'profile', 'date-search', 'time-search', 'species-search', 'type-search','treatment-search', 'profile-three' , 'status-search', {data : ['date']}],
    page: 5,
    pagination: true,
};

var userList = new List('appointment', options);


document.querySelector('.show-entries').addEventListener('change', function () {
  var selectedValue = parseInt(this.value);
  userList.page = selectedValue;
  userList.update();
});

