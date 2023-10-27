window.onload = function() {
    const toast = document.querySelector(".toast");
    const progress = document.querySelector(".progress");
    let timer1, timer2;

    // Automatically show the toast when the page loads
    toast.classList.add("active");
    progress.classList.add("active");

    // Set a timer to hide the toast after a certain delay
    timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, 5000); // 1s = 1000 milliseconds

    // Set a timer to hide the progress bar
    timer2 = setTimeout(() => {
        progress.classList.remove("active");
    }, 5300);

    // Optionally, you can allow users to close the toast manually
    const closeIcon = document.querySelector(".close");
    closeIcon.addEventListener("click", () => {
        toast.classList.remove("active");
        setTimeout(() => {
            progress.classList.remove("active");
        }, 300);
        clearTimeout(timer1);
        clearTimeout(timer2);
    });
};
