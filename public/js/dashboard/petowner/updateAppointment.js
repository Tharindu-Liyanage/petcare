var today = new Date();
//yesterday.setDate(yesterday.getDate() - 1);
var currentDate = new Date();
var nextWeek = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 6);

const picker = new easepick.create({
    element: document.getElementById('datepicker'),
    plugins: ['LockPlugin'],
    LockPlugin: {
        minDate: today,
        maxDate: nextWeek,
    },
    css: [
      'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
    ],

    setup(picker) {
    picker.on('select', (date) => {
        console.log('Selected Date:', datepicker.value);
        generateDateHelper(datepicker.value);
        });
    },
  });

  window.onload = function() {
    generateDateHelper(datepicker.value);
    };

  //add event listener to datepicker amd generate time slots
    const datepicker = document.getElementById('datepicker');

  
    

function getDayName(dateString) {
    const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const date = new Date(dateString);
    const dayIndex = date.getDay();
    
    return daysOfWeek[dayIndex];
}

function generateDateHelper(date){

    if(getDayName(date) == 'Monday'){
        generateTimeSlotsAndAppend(mondayMorningStartTime,mondayMorningEndTime,mondayAfternoonStartTime,mondayAfternoonEndTime,mondayTimeInterval);
    }else if(getDayName(date) == 'Tuesday'){
        generateTimeSlotsAndAppend(tuesdayMorningStartTime,tuesdayMorningEndTime,tuesdayAfternoonStartTime,tuesdayAfternoonEndTime,tuesdayTimeInterval);
    
    }else if(getDayName(date) == 'Wednesday'){
        generateTimeSlotsAndAppend(wednesdayMorningStartTime,wednesdayMorningEndTime,wednesdayAfternoonStartTime,wednesdayAfternoonEndTime,wednesdayTimeInterval);
    }
    else if(getDayName(date) == 'Thursday'){
        generateTimeSlotsAndAppend(thursdayMorningStartTime,thursdayMorningEndTime,thursdayAfternoonStartTime,thursdayAfternoonEndTime,thursdayTimeInterval);
    }
    else if(getDayName(date) == 'Friday'){
        generateTimeSlotsAndAppend(fridayMorningStartTime,fridayMorningEndTime,fridayAfternoonStartTime,fridayAfternoonEndTime,fridayTimeInterval);
    }
    else if(getDayName(date) == 'Saturday'){
        generateTimeSlotsAndAppend(saturdayMorningStartTime,saturdayMorningEndTime,saturdayAfternoonStartTime,saturdayAfternoonEndTime,saturdayTimeInterval);
    }
    else if(getDayName(date) == 'Sunday'){
        generateTimeSlotsAndAppend(sundayMorningStartTime,sundayMorningEndTime,sundayAfternoonStartTime,sundayAfternoonEndTime,sundayTimeInterval);
    }

 }


  function generateTimeSlotsAndAppend(mstartDateTime, mendDateTime, astartDateTime, aendDateTime, interval) {
    const MorningstartDate = new Date(`1970-01-01T${mstartDateTime}`);
    const MorningendDate = new Date(`1970-01-01T${mendDateTime}`);

    const afternoonstartDate = new Date(`1970-01-01T${astartDateTime}`);
    const afternoonendDate = new Date(`1970-01-01T${aendDateTime}`);

  

    const formatTime = (date) => {
        return date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' ,timeZone: 'Asia/Kolkata' });
    };

    const timeSlotsSelect = document.getElementById('timeSlotsSelect');

    // Clear existing options in the select
    timeSlotsSelect.innerHTML = '';

    let mcurrentTime = MorningstartDate;
    let acurrentTime = afternoonstartDate;

    while (MorningstartDate <= MorningendDate) {
        const formattedTime = formatTime(mcurrentTime);

        const option = document.createElement('option');
        option.value = formattedTime;
        option.text = formattedTime;

        

        var currentTime = new Date(); // This will return current time

        if (currentTime.toISOString().split('T')[0] === datepicker.value) {

            //9:00 AM formate to real time formate
            var timeDate = timeFormateToOriginal(formattedTime);
            
                if(currentTime.getTime() > timeDate.getTime()){
                    option.disabled = true;
                    if (formattedTime === selectedTime) {
                        option.selected = true;
                        option.disabled = false;
                    }
                }
            
            }

        
       
        


        timeSlotsSelect.add(option);



        mcurrentTime.setMinutes(mcurrentTime.getMinutes() + parseInt(interval, 10));
    }

    while (afternoonstartDate <= afternoonendDate) {
        const formattedTime = formatTime(acurrentTime);

        const option = document.createElement('option');
        option.value = formattedTime;
        option.text = formattedTime;

        if (formattedTime === selectedTime) {
            option.selected = true;
        }


        var currentTime = new Date(); // This will return current time

        if (currentTime.toISOString().split('T')[0] === datepicker.value) {

            //9:00 AM formate to real time formate
            var timeDate = timeFormateToOriginal(formattedTime);
            
                if(currentTime.getTime() > timeDate.getTime()){
                    option.disabled = true;
                    if (formattedTime === selectedTime) {
                        option.selected = true;
                        option.disabled = false;
                    }
                }
            
        }

        


        

        timeSlotsSelect.add(option);



        acurrentTime.setMinutes(acurrentTime.getMinutes() + parseInt(interval, 10));
    }
}


 //formate if give 9:00 AM to orginal formate
 function timeFormateToOriginal(time){
    var [hours, minutes, period] = time.match(/(\d+):(\d+) ([APMapm]{2})/).slice(1);
    hours = parseInt(hours);
    if (period.toLowerCase() === 'pm' && hours !== 12) {
        hours += 12;
    }
    var timeDate = new Date();
    timeDate.setHours(hours, parseInt(minutes), 0, 0);

    return timeDate;
}
