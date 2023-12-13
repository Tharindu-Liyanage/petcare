var yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
var currentDate = new Date();
var nextWeek = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 6);





// Example usage:
const nextDays = getNextDaysOfWeek(targetDays);





// new code over

const picker = new Litepicker({ 
  element: document.getElementById('litepicker'), 
  selectBackward: true,
  resetButton: true,
  minDate: yesterday,
  maxDate: nextWeek,
  lockDays : nextDays,
  autoRefresh: true, // Automatically refresh the picker
  inlineMode: true,
  
});


/// Add click event listener to the container (delegated to '.time-slot-container')
const timeSlotContainer = document.querySelector('.time-slot-container');

timeSlotContainer.addEventListener('click', (event) => {
    const clickedSlot = event.target.closest('.time-slot');

    if (clickedSlot) {
        // Remove active class from all time slots
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.remove('active');
        });

        // Add active class to the clicked time slot
        clickedSlot.classList.add('active');

        // Set the value of the hidden input
        const input = clickedSlot.querySelector('input');
        if (input) {
            input.checked = true;
        }
    }
});



// Add an event listener for the 'selected' event
picker.on('selected', function (date) {
  // Get the selected date and update the hidden input value
  var selectedDate = picker.getDate();
  document.getElementById('litepicker').value = selectedDate.format('YYYY-MM-DD');
  console.log(selectedDate);
  console.log('Date selected:', selectedDate.format('YYYY-MM-DD'));
});

//get next day
function getNextDaysOfWeek(targetDays) {
  const daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

  const today = new Date();
  const currentDay = today.getDay(); // 0 for Sunday, 1 for Monday, ..., 6 for Saturday

  const nextDays = targetDays.map(targetDay => {
    const targetDayIndex = daysOfWeek.indexOf(targetDay);
    let daysUntilTargetDay = targetDayIndex - currentDay;

    // If the target day is before or the same as the current day, move to the next week
    if (daysUntilTargetDay < 0) {
      daysUntilTargetDay += 7;
    }

    const nextTargetDate = new Date(today);
    nextTargetDate.setDate(today.getDate() + daysUntilTargetDay);

    return nextTargetDate.toISOString().split('T')[0]; // Format as 'YYYY-MM-DD'
  });

  return nextDays;
}