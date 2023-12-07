var yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
var currentDate = new Date();
var endOfWeek = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + (6 - currentDate.getDay()));

const picker = new Litepicker({ 
  element: document.getElementById('litepicker'), 
 
  selectBackward: true,
  resetButton: true,
  minDate: yesterday,
  maxDate: endOfWeek,
  autoRefresh: true, // Automatically refresh the picker
  inlineMode: true,
  
});


// Add click event listener to time slots
const timeSlots = document.querySelectorAll('.time-slot');

timeSlots.forEach(slot => {
  slot.addEventListener('click', () => {
    // Remove active class from all time slots
    timeSlots.forEach(s => s.classList.remove('active'));

    // Add active class to the clicked time slot
    slot.classList.add('active');

    // Set the value of the hidden input
    const input = slot.querySelector('input');
    if (input) {
      input.checked = true;
    }
  });
});


// Add an event listener for the 'selected' event
picker.on('selected', function (date) {
  // Get the selected date and update the hidden input value
  var selectedDate = picker.getDate();
  document.getElementById('litepicker').value = selectedDate.format('YYYY-MM-DD');
  console.log(selectedDate);
  console.log('Date selected:', selectedDate.format('YYYY-MM-DD'));
});