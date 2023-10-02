const fileInputs = document.querySelectorAll('.input-file');

        fileInputs.forEach(input => {
            input.addEventListener('change', () => {
                const file = input.files[0];
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];

                if (file && allowedTypes.includes(file.type)) {
                    // File is valid
                    console.log('File is valid:', file.name);
                } else {
                    // File is not valid
                    alert('Please select a valid PDF or image file.');
                    input.value = ''; // Clear the input field
                }
            });
        });