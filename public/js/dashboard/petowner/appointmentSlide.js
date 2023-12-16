initMultiStepForm();


function initMultiStepForm() {
    const progressNumber = document.querySelectorAll(".step").length;
    const slidePage = document.querySelector(".slide-page");
    const submitBtn = document.querySelector(".submit");
    const progressText = document.querySelectorAll(".step p");
    const progressCheck = document.querySelectorAll(".step .check");
    const bullet = document.querySelectorAll(".step .bullet");
    const pages = document.querySelectorAll(".page");
    const nextButtons = document.querySelectorAll(".next");
    const prevButtons = document.querySelectorAll(".prev");
    const stepsNumber = pages.length;
    

    if (progressNumber !== stepsNumber) {
        console.warn(
            "Error, number of steps in progress bar do not match number of pages"
        );
    }

    document.documentElement.style.setProperty("--stepNumber", stepsNumber);

    let current = 1;

    
    

    for (let i = 0; i < nextButtons.length; i++) {
        
        nextButtons[i].addEventListener("click", async function (event) {
            event.preventDefault();

            console.log(this.parentElement.parentElement);
           // inputsValid = validateInputs(this);
           inputsValid = await validateInputs(this.parentElement.parentElement);
            
            // inputsValid = true;

            if (inputsValid) {  // if only valid it goes to next page
               slidePage.style.marginLeft = `-${
                    (100 / stepsNumber) * current
                }%`;
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
            }
            
           
        });
    }

    for (let i = 0; i < prevButtons.length; i++) {
        prevButtons[i].addEventListener("click", function (event) {
            event.preventDefault();
            slidePage.style.marginLeft = `-${
                (100 / stepsNumber) * (current - 2)
            }%`;
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
    }

    submitBtn.addEventListener("click", async function () {
        submitBtn.disabled = true; // bcz stop submitting before check errrors
    
        var timeInput = document.querySelector('input[type="radio"][name="time"]:checked');
        var dateInput = document.getElementById("litepicker");
    
        try {

                 /*
                        --ERRORS IN SUBMIT PAGE--

                        1.Time can be booked or loked after render submit page.
                        2.Time slot can be old, eg- now time 8.35 AM and user select old renderd time slot 8.30 AM   * if only selected date today
                        3.Date can be a holiday.
                        

                */


            var isBookedOrLocked = await timeSlotBookedOrLocked(timeInput.value);
            var isHoliday = await checkHoliday();

            var oldtime =false;

            var currentTime = new Date(); 

            if (currentTime.toISOString().split('T')[0] === dateInput.value) { // if selcted date today

                //9:00 AM formate to real time formate
                 var timeDate = timeFormateToOriginal(timeInput.value);

                if(currentTime.getTime() > timeDate.getTime()){
                    oldtime = true;
                }else{
                    oldtime = false;
                }
            
            }
    
            if ((isBookedOrLocked === "booked" || isBookedOrLocked === "locked") || isHoliday || oldtime) {


                let errorTitleElementFinal = document.getElementById('error-final-title');
                if (isBookedOrLocked === "booked" || isBookedOrLocked === "locked") {
                    errorTitleElementFinal.innerHTML = `❌Time slot not available: already booked or locked by another user.`;
                } else if (isHoliday) {
                    errorTitleElementFinal.innerHTML = `❌The selected date is not accessible as it is marked as a holiday.`;
                } else if (oldtime) {
                    errorTitleElementFinal.innerHTML = `❌The selected time is not accessible now.`;
                }
                
                document.getElementById('error-final-container').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('error-final-container').style.display = 'none';
                }, 5000);


            } else if (isBookedOrLocked === "" && !isHoliday && !oldtime) {
                document.getElementById('error-final-container').style.display = 'none';
                await timeSlotLock(timeInput.value);
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
                document.getElementById('appointment-form').submit();
            }
        } catch (error) {
            console.error('Error processing form submission:', error);
        } finally {
            // Enable the button after the asynchronous operations
            submitBtn.disabled = false;
        }
    });



// ===========  Validaint Input Function Start ===========  //
    

    async function validateInputs(ths) {
        let inputsValid = true;

        /*
        There are 4 pages in slide

        1. slide-page (class name) 1st input page
        2. datecheck (class name)   calender page
        3. timecheck (class name)   timeslot page
        4. submit page (class name)  submit page not in this function .

        */

        //===============  1 st page validating =========================//

        if (ths.classList.contains("slide-page")) {
            const inputs = ths.parentElement.parentElement.querySelectorAll(".page.slide-page input ,.page.slide-page select ");
            const errorTitleElement = document.getElementById('error-pageslide-title');
            const errorContainer = document.getElementById('error-pageslide-container');
        
            let countInputErrors = 0;
        
            for (let i = 0; i < inputs.length; i++) {
                const valid = inputs[i].checkValidity();
                const isEmpty = inputs[i].value.trim() === '';
        
                // Declare inputFormParent outside of the if block
                const inputFormParent = inputs[i].closest('.inputForm');
        
                if (!valid || isEmpty) {
                    inputsValid = false;
                    countInputErrors++;
        
                    if (inputFormParent) {
                        inputFormParent.classList.add('is-invalid');
                    }
                } else {
                    // Move this part inside the else block
                    if (inputFormParent) {
                        inputFormParent.classList.remove('is-invalid');
                    }
                }
            }
        
            if (countInputErrors > 0) {
                // Set the error message when there are input errors
                errorTitleElement.innerHTML = `Error: There are ${countInputErrors} missing or invalid fields`;
                errorContainer.style.display = 'block';
            } else {
                // Hide the error container if there are no errors
                errorContainer.style.display = 'none';

            }
        }
        
        //===============  1 st page validating  over =========================//


        //===============  2nd page validating ================================//
          

        if (ths.classList.contains("datecheck")) {
            console.log('im in date');
            let errorTitleElementDate = document.getElementById('error-datecheck-title');
            // Check Litepicker input only on the second page
            const litepickerInput = ths.querySelector('#litepicker');
            if (litepickerInput) {
                const litepickerValid = litepickerInput.value.trim() !== '';
                if (!litepickerValid) {
                    inputsValid = false;
                    errorTitleElementDate.innerHTML = `Error: Please Select a Date`;
                    document.getElementById('error-datecheck-container').style.display = 'block';
                } else {

                    /*
                        --ERRORS IN DATECHECK--

                        1.Day Can be a holiday after rendered calender
                        2.Not selecte a Date

                    */
                   

                    var isHoliday = await checkHoliday();

                    if(isHoliday){

                        inputsValid = false;
                        errorTitleElementDate.innerHTML = `❌The selected date is not accessible as it is marked as a holiday.`;
                        document.getElementById('error-datecheck-container').style.display = 'block';
                         setTimeout(() => {
                             document.getElementById('error-datecheck-container').style.display = 'none';
                        }, 5000);


                    }else{
                        litepickerInput.classList.remove("is-invalid");
                        document.getElementById('error-datecheck-container').style.display = 'none';
                        generateDateHelper(litepickerInput.value);
                    }
                    
                }
            }
        }

        //======================       2nd page validating over ===========================//


        //======================       3rd page validating ===========================//

        if (ths.classList.contains("timecheck")) {
            console.log('im in time');

            let errorTitleElementTime = document.getElementById('error-timecheck-title');
            // Check if at least one radio button with id "time" is checked
            const inputRadios = ths.querySelectorAll('input[type="radio"]:checked');
            
            if (inputRadios.length === 0) {
                // No radio button with id "time" is checked
                inputsValid = false;
                
                // Add "is-invalid" class to all radio buttons with id "time"
                errorTitleElementTime.innerHTML = `Error: Please Select a Time`;
                document.getElementById('error-timecheck-container').style.display = 'block';
                
            } else {
                // At least one radio button with id "time" is checked

                /*
                        --ERRORS IN TIME CHECK--

                        1.Time can be booked or loked after render time slots.
                        2.Time slot can be old, eg- now time 8.35 AM and user select old renderd time slot 8.30 AM
                        3.NOt select a time slot.

                */
             


                 //values for parameters 

                 var timeInput = document.querySelector('input[type="radio"][name="time"]:checked');
                 var dateInput = document.getElementById("litepicker");
                 var selectVet = document.getElementById('vet'); //vet

                 console.log(timeInput.value);
                 console.log(dateInput.value);
                 console.log(selectVet.value);

                        try {


                        // error 1: is bookslot available? getting from ajax requset
                        const isAvailable = await checkAvailability(selectVet.value, timeInput.value, dateInput.value);
                        

                        //error2: ========= old time check start ========//
                      

                        var oldtime =false;

                        var currentTime = new Date(); 

                        if (currentTime.toISOString().split('T')[0] === dateInput.value) {

                            //9:00 AM formate to real time formate
                             var timeDate = timeFormateToOriginal(timeInput.value);
        
                            if(currentTime.getTime() > timeDate.getTime()){
                                oldtime = true;
                            }else{
                                oldtime = false;
                            }
                        
                        }

                        //======== old time check over =============//

                        //error3: ======== is Time slot locked =============//

                        var islocked = false;
                        //if locked slot
                        var isBookedOrLocked = await timeSlotBookedOrLocked(timeInput.value);
                        if (isBookedOrLocked == "locked") {
                            islocked = true;    
                        }

                        // ======== is Time slot locked over =============//

                        
                  
                        //going to check errors

                        if (isAvailable && !oldtime && !islocked) {
                            // Time slot is available, proceed with your logic
                            document.getElementById('error-timecheck-container').style.display = 'none';
                            updateValueLastPage(); // update last page

                            
                            

                        } else {
                            // Time slot is not available, handle accordingly
                            console.log('Sorry: Time Slot booked');
                            inputsValid = false;
                            

                            errorTitleElementTime.innerHTML = `❌ Oops! This time slot is unavailable. Please choose another one.`;
                            document.getElementById('error-timecheck-container').style.display = 'block';
                            
                            setTimeout(() => {
                                document.getElementById('error-timecheck-container').style.display = 'none';
                            }, 5000);

                           
                        }
                    } catch (error) {
                        // Handle errors (e.g., network issues)
                        console.error('Error:', error);
                        inputsValid = false;
                    }


            }
        }

        //======================    3rd page validating over ===========================//
        
        
        console.log('yatama')
        console.log(inputsValid);
        return inputsValid;
    }


// ===========  Validaint Input Function over ===========  //



                /*
                Other function start here, which need for validating pages
                */



    //============================= GetdatName function here ========================================

    function getDayName(dateString) {
        const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const date = new Date(dateString);
        const dayIndex = date.getDay();
        
        return daysOfWeek[dayIndex];
    }


     //============================= generate time values  ========================================

     async function generateTimeSlotsAndAppend(mstartDateTime, mendDateTime,astartDateTime,aendDateTime, interval) {
        const MorningstartDate = new Date(`1970-01-01T${mstartDateTime}`);
        const MorningendDate = new Date(`1970-01-01T${mendDateTime}`);

        const afternoonstartDate = new Date(`1970-01-01T${astartDateTime}`);
        const afternoonendDate = new Date(`1970-01-01T${aendDateTime}`);
        
        const formatTime = (date) => {
            return date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
        };
    
        const timeSlotContainer = document.querySelector('.time-slot-container');
        let mcurrentTime = MorningstartDate;
        let acurrentTime = afternoonstartDate;
        // Clear existing content in the container
        timeSlotContainer.innerHTML = '';
    
        while (MorningstartDate <= MorningendDate) {
            const formattedTime = formatTime(mcurrentTime);
            //const inputId = `time-${formattedTime.replace(/[:\s]/g, '')}`;
    
            const label = document.createElement('label');
            label.classList.add('time-slot');
    
            const input = document.createElement('input');
            input.type = 'radio';
            input.name = 'time';
            input.value = formattedTime;
            input.id = 'time';
    
            const textNode = document.createTextNode(`${formattedTime}`);
    
            label.appendChild(input);
            label.appendChild(textNode);
            timeSlotContainer.appendChild(label);

            await checkTimeSlotBooking(formattedTime, label);//new
    
            mcurrentTime.setMinutes(mcurrentTime.getMinutes() + parseInt(interval, 10));
        }

        while (afternoonstartDate <= afternoonendDate) {
            const formattedTime = formatTime(acurrentTime);
            //const inputId = `time-${formattedTime.replace(/[:\s]/g, '')}`;
    
            const label = document.createElement('label');
            label.classList.add('time-slot');
    
            const input = document.createElement('input');
            input.type = 'radio';
            input.name = 'time';
            input.value = formattedTime;
            input.id = 'time';
    
            const textNode = document.createTextNode(`${formattedTime}`);
    
            label.appendChild(input);
            label.appendChild(textNode);
            timeSlotContainer.appendChild(label);

           await checkTimeSlotBooking(formattedTime, label); //new
    
            acurrentTime.setMinutes(acurrentTime.getMinutes() + parseInt(interval, 10));
        }
    }


    //================================ Ajax request for time slots check ===========================

    async function checkAvailability(vetId, selectedTime, selectedDate) {
        try {
            const response = await fetch('checkAvailabilityTimeSlots', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    selectedVetId: vetId,
                    selectedTime: selectedTime,
                    selectedDate: selectedDate,
                }),
            });
    
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
    
            const data = await response.json();
            return data.available;
        } catch (error) {
            console.error('Error during fetch:', error);
            throw error; // Propagate the error
        }
    }
    

    // checking booking slot  booked or not and change (ajax function) 1

   async function checkTimeSlotBooking(time, label) {

    //also checkin is old time slot
       var dateInput = document.getElementById("litepicker");
       
       
       var oldtime =false;

       var currentTime = new Date(); 

       if (currentTime.toISOString().split('T')[0] === dateInput.value) {

        //9:00 AM formate to real time formate
        var timeDate = timeFormateToOriginal(time);
        
            if(currentTime.getTime() > timeDate.getTime()){
                oldtime = true;
            }else{
                oldtime = false;
            }
        
        }
    

        var isBookedOrLocked = await timeSlotBookedOrLocked(time); // Implement this function

        if (isBookedOrLocked == "booked") {
            label.classList.add('booked'); //booked
            
        }else if(isBookedOrLocked == "locked"){
            label.classList.add('locked'); //locked
        }else if(oldtime){
            label.classList.add('old-timeslot'); //locked
        }
    
    }

    // checking booking slot  booked or not and change (ajax function) 2

    async function timeSlotBookedOrLocked(time) {
        try {
            
            const dateInput = document.getElementById("litepicker");
            const selectVet = document.getElementById('vet'); // vet
    
            const response = await fetch('timeSlotBookedOrLocked', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    selectedTime: time,
                    selectedDate: dateInput.value,
                    selectedVetId: selectVet.value,
                }),
            });
    
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
    
            const data = await response.json();
            return data.available;
        } catch (error) {
            console.error('Error:', error);
            return false;
        }
    }

    // time slot lock ajax function here

    async function timeSlotLock() {
        try {
            const timeInput = document.querySelector('input[type="radio"][name="time"]:checked');
            const dateInput = document.getElementById("litepicker");
            const selectVet = document.getElementById('vet'); // vet

            const currentTime = new Date();

            // Calculate the end time by adding 32 minutes to the current time
            const endTime = new Date(currentTime.getTime() + 32 * 60 * 1000);
                        
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const formattedEndTime = endTime.toLocaleTimeString('en-US', options);
            const formattedStartTime = currentTime.toLocaleTimeString('en-US', options);
    
            const response = await fetch('timeSlotLock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    selectedTime: timeInput.value,
                    selectedDate: dateInput.value,
                    selectedVetId: selectVet.value,
                    endTimeLock: formattedEndTime,
                    startTimeLock:formattedStartTime,
                }),
            });
    
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
    
            const data = await response.json();
            return data.locked;
        } catch (error) {
            console.error('Error:', error);
            return false;
        }
    }

    //get holiday day name

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

    async function checkHoliday() {
        try {
          var holidayArray = await getHolidayDateName();
          var HolidayDateArray = await getNextDaysOfWeek(holidayArray);
          var dateInputForCheckHoliday = document.getElementById("litepicker").value; // Make sure to get the value property
      
          var isHoliday = HolidayDateArray.includes(dateInputForCheckHoliday);

          return isHoliday;

        } catch (error) {
          console.error('Error checking holiday:', error);
        }
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



    //============================= After time check this UpdateValueLastPage function work  ========================================



    function updateValueLastPage() {

        //1
        //=============== Get the input element by its id=======================
        var lastNameInput = document.getElementById("last-name");
        var firstNameInput = document.getElementById("first-name");
        //var timeInput = document.getElementById("time");
        var timeInput = document.querySelector('input[type="radio"][name="time"]:checked');
        var dateInput = document.getElementById("litepicker");

        //=============== Get the input element by its id over======================= //


        //=============== Get the selct element by its id vet and pet======================= //

        var selectPet = document.getElementById('pet');  // Assuming 'pet' is the ID of your <select> element
        var selectOption = selectPet.options[selectPet.selectedIndex];
        
        var petText = selectOption.text.trim();
        var petIdMatch = petText.match(/PET-(\d+) \| (.+)/i);
        
        var petId = petIdMatch ? 'PET-' + petIdMatch[1] : '';
        var petName = petIdMatch ? petIdMatch[2] : '';
        
        console.log('Pet ID:', petId);
        console.log('Pet Name:', petName);
        


        const selectVet = document.getElementById('vet'); //vet
        const selectedVetName = selectVet.options[selectVet.selectedIndex].text; //vet name


        //=============== Get the selct element by its id vet and pet over======================= //
        

        //2
        // Get the value of the input element
        var lastNameValue = lastNameInput.value;
        var firstNameValue = firstNameInput.value;
        var timeValue = timeInput.value;
        var dateValue = dateInput.value;

       


        //3
        // Get the span element by its id
        var petOwnerNameSpan = document.getElementById("pet-owner-name");
        var timeSpan = document.getElementById("time-last");
        var dateSpan = document.getElementById("date-last");
        var petIdSpan = document.getElementById("pet-id");
        var petNameSpan = document.getElementById("pet-name");
        var vetNameSpan = document.getElementById("vet-last");

    

        //4
        // Set the innerHTML of the span element to the value of the input

        petOwnerNameSpan.innerHTML = firstNameValue + ' ' + lastNameValue;
        timeSpan.innerHTML = timeValue;
        dateSpan.innerHTML = dateValue;
        petIdSpan.innerHTML = petId;
        petNameSpan.innerHTML = petName;
        vetNameSpan.innerHTML = selectedVetName;



    }


    /*
    =============other function over ==================
    */
  
}

// initMultiStepForm is over here




