var yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
var currentDate = new Date();
var nextWeek = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 6);

let picker;



async function initializeLitepicker() {
  try {

     // Destroy the existing Litepicker instance if it exists
     if (picker) {
      picker.destroy();
    }
   

   
    var HolidayDateArray = await refreshHolidayData()

    // Create a new Litepicker instance
    picker = new Litepicker({
      element: document.getElementById('litepicker'),
      selectBackward: true,
      resetButton: true,
      minDate: yesterday,
      maxDate: nextWeek,
      lockDays: HolidayDateArray,
      autoRefresh: true,
      inlineMode: true,
    });

   

    console.log('Litepicker initialized or refreshed');
  } catch (error) {
    console.error('Error initializing or refreshing Litepicker:', error);
  }
}

// Call the function initially
initializeLitepicker();


//const refreshLitepickerInterval = setInterval(initializeLitepicker, 10sec);
const refreshLitepickerInterval = setInterval(initializeLitepicker, 10000);   //refeshing this for update holiday on calender




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

/*

// Add an event listener for the 'selected' event
picker.on('selected', function (date) {
  // Get the selected date and update the hidden input value
  var selectedDate = picker.getDate();
  document.getElementById('litepicker').value = selectedDate.format('YYYY-MM-DD');
  console.log(selectedDate);
  console.log('Date selected:', selectedDate.format('YYYY-MM-DD'));
});
*/

//this function give realt date for given date name , if today sunday it give today date , if today monday i give sunday it give next sunday date
async function getNextDaysOfWeek(targetDays) {
  const daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

  const today = new Date();
  const currentDay = today.getDay(); // 0 for Sunday, 1 for Monday, ..., 6 for Saturday

  const nextDays = targetDays.map(targetDay => {
    // Determine the target day based on the input type
    const targetDayName = typeof targetDay === 'object' ? targetDay.day.toLowerCase() : targetDay.toLowerCase();

    // Find the index of the target day in the daysOfWeek array
    const targetDayIndex = daysOfWeek.indexOf(targetDayName);

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


//for refreshHolidayData  this will get holiday date name from database

async function getHolidayDateName() {
  try {
      const response = await fetch('getHolidayDetails', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
          },
          // No body for this request
      });

      if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();
      return data.holidays;
  } catch (error) {
      console.error('Error during fetch:', error);
      throw error; // Propagate the error
  }
}

//this will convert date name to date name and it return to litepicker lockDay array

async function refreshHolidayData() {
  try {
    holidayArray = await getHolidayDateName();
    HolidayDateArray = await getNextDaysOfWeek(holidayArray);
    console.log('Data refreshed:', holidayArray, HolidayDateArray);
    return HolidayDateArray;
  } catch (error) {
    console.error('Error refreshing data:', error);
  }
}




