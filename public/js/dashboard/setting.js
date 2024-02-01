const tabs = document.querySelectorAll('.tab-btn');
const all_content = document.querySelectorAll('.inner-content');
const line = document.querySelector('.line');

// Retrieve the active tab index from local storage
const activeTabIndex = localStorage.getItem('activeTabIndex');

// Set the initial active tab based on the stored index
if (activeTabIndex !== null && activeTabIndex >= 0 && activeTabIndex < tabs.length) {
    tabs.forEach((tab) => tab.classList.remove('active'));
    tabs[activeTabIndex].classList.add('active');
    line.style.width = tabs[activeTabIndex].offsetWidth + 'px';
    line.style.left = tabs[activeTabIndex].offsetLeft + 'px';
    all_content.forEach((content) => content.classList.remove('active'));
    all_content[activeTabIndex].classList.add('active');
} else {
    // Default to the first tab if no activeTabIndex is stored
    tabs[0].classList.add('active');
    line.style.width = tabs[0].offsetWidth + 'px';
    line.style.left = tabs[0].offsetLeft + 'px';
    all_content[0].classList.add('active');
}

tabs.forEach((tab, index) => {
    tab.addEventListener('click', (e) => {
        tabs.forEach((tab) => tab.classList.remove('active'));
        tab.classList.add('active');

        // Store the active tab index in local storage
        localStorage.setItem('activeTabIndex', index);

        line.style.width = e.target.offsetWidth + 'px';
        line.style.left = e.target.offsetLeft + 'px';

        all_content.forEach((content) => content.classList.remove('active'));
        all_content[index].classList.add('active');
    });
});
