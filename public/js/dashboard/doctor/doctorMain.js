document.addEventListener("DOMContentLoaded", function() {
    var oldData;
    var appointment_details_container = document.getElementById("appointmentDetails-container");

    async function updateAppointmentDetails() {
        try {
            const response = await fetch('/petcare/doctor/getCurrentAppointment', {
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

            // Example: Log the appointments
            console.log(data);

            return data; // Return the appointments data
        } catch (error) {
            console.error('Error during fetch:', error);
            throw error; // Propagate the error
        }
    }

    // Assume this function is inside a larger context
    async function updateAppointmentDetailsAndHTML() {
        try {
            // Call the function to get appointment details
            const data = await updateAppointmentDetails();

            if (data == null) {
                appointment_details_container.innerHTML = `
                <div class="home-left2">
                    <div class="home-text-large">
                        Currently, <span id="petName">No Appointments!</span>
                    </div>

                    <div class="date-time-type">
                        <div>Date : <span id="appointmentDate"></span></div>
                        <div>Time : <span id="appointmentTime"></span></div>
                        <div>Type : <span id="appointmentType"></span></div>
                    </div>
                    <div class="buttons">
                        <button class="button cancel-button">Cancel</button>
                        <button class="button treatment-button">Treatment</button>
                    </div>
                </div>
                <div class="home-right">
                    <img id="petImage" src="http://localhost/petcare/public/img/dashboard/noappointment.svg" alt="">
                </div>`;
            } else {
                // Appointments are available, update HTML with details
                appointment_details_container.innerHTML = `
                <div class="home-left2">
                    <div class="home-text-large">
                        Time for Treatment, <span id="petName">${data.pet}!</span>
                    </div>
                    <div class="date-time-type">
                        <div>Date : <span id="appointmentDate">${data.appointment_date}</span></div>
                        <div>Time : <span id="appointmentTime">${data.appointment_time}</span></div>
                        <div>Type : <span id="appointmentType">${data.appointment_type}</span></div>
                    </div>
                    <div class="buttons">
                        <button class="button cancel-button">Cancel</button>
                        <button class="button treatment-button">Treatment</button>
                    </div>
                </div>
                <div class="home-right">
                    <img id="petImage" src="http://localhost/petcare/public/storage/uploads/animals/${data.profileImage}" alt="">
                </div>`;
            }

        } catch (error) {
            console.error('Error during updateAppointmentDetailsAndHTML:', error);
            // Handle the error as needed
        }
    }

    // Example: Refresh appointment details every 30 seconds
    setInterval(updateAppointmentDetailsAndHTML, 5000);
});
