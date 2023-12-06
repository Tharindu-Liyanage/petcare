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
        
        nextButtons[i].addEventListener("click", function (event) {
            event.preventDefault();

            console.log(this.parentElement.parentElement);
           // inputsValid = validateInputs(this);
           inputsValid = validateInputs(this.parentElement.parentElement);
            
            // inputsValid = true;

            if (inputsValid) {
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

    submitBtn.addEventListener("click", function () {
        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
       
    });

    function validateInputs(ths) {
        let inputsValid = true;

        
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
                    litepickerInput.classList.remove("is-invalid");
                    document.getElementById('error-datecheck-container').style.display = 'none';
                }
            }
        }

        if (ths.classList.contains("timecheck")) {
            console.log('im in time');

            let errorTitleElementTime = document.getElementById('error-timecheck-title');
            // Check if at least one radio button with id "time" is checked
            const inputRadios = ths.querySelectorAll('input[type="radio"][id="time"]:checked');
            
            if (inputRadios.length === 0) {
                // No radio button with id "time" is checked
                inputsValid = false;
                
                // Add "is-invalid" class to all radio buttons with id "time"
                errorTitleElementTime.innerHTML = `Error: Please Select a Time`;
                document.getElementById('error-timecheck-container').style.display = 'block';
                
            } else {
                // At least one radio button with id "time" is checked
                document.getElementById('error-timecheck-container').style.display = 'none';
                updateValueLastPage(); //update last page
            }
        }
        
        

        console.log(inputsValid);
        return inputsValid;
    }

    function updateValueLastPage() {

        //1
        // Get the input element by its id
        var lastNameInput = document.getElementById("last-name");
        var firstNameInput = document.getElementById("first-name");
        var timeInput = document.getElementById("time");
        var dateInput = document.getElementById("litepicker");


        var selectPet = document.getElementById('pet');
        var selectOption = selectPet.options[selectPet.selectedIndex];
        

        // Get the value of the input element
        var lastNameValue = lastNameInput.value;
        var firstNameValue = firstNameInput.value;
        var timeValue = timeInput.value;
        var dateValue = dateInput.value;


       // Extract pet ID and name from the selected option
        var petText = selectOption.text.trim();
        var petIdMatch = petText.match(/Id: (\d+)/i); // Match the ID pattern

        var petId = petIdMatch ? petIdMatch[1] : ''; // Extract the matched ID, if any
        var petName = petText.replace(/Id: \d+/i, '').replace(/^\s*\|\s*/, '').trim(); // Remove the ID and leading pipe, if any

        // Get the span element by its id
        var petOwnerNameSpan = document.getElementById("pet-owner-name");
        var timeSpan = document.getElementById("time-last");
        var dateSpan = document.getElementById("date-last");
        var petIdSpan = document.getElementById("pet-id");
        var petNameSpan = document.getElementById("pet-name");


    
        // Set the innerHTML of the span element to the value of the input
        petOwnerNameSpan.innerHTML = firstNameValue + ' ' + lastNameValue;
        timeSpan.innerHTML = timeValue;
        dateSpan.innerHTML = dateValue;
        petIdSpan.innerHTML = petId;
        petNameSpan.innerHTML = petName;



    }




    
    
}

