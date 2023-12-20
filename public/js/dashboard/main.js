/*

const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});  


const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click' ,function(e){
    if (window.innerWidth < 576){
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')){
            searchBtnIcon.classList.replace('bx-search','bs-x');
        }else{
            searchBtnIcon.classList.replace('bx-x', 'bx-search')
        }
    }
});

window.addEventListener('resize', ()=>{
    if(window.innerWidth <768){
        sideBar.classList.add('close');
    }else {
        sideBar.classList.remove('close');
    }

    

    if(window.innerWidth> 576){
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});


const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change' , function(){
    if(this.checked){
        document.body.classList.add('dark');
    }
    else {
        document.body.classList.remove('dark');
    }
});

*/

/* 22222222222222222222222222222222*/

// Retrieve the state of the sidebar from local storage
        const isSidebarClosed = localStorage.getItem('sidebarClosed');
        const sideBar = document.querySelector('.sidebar');

        if (isSidebarClosed === 'true') {
            sideBar.classList.add('close');
        }

        // Retrieve the state of the search bar from local storage
        const isSearchBarShown = localStorage.getItem('searchBarShown');
        //const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
        //const searchForm = document.querySelector('.content nav form');

        if (isSearchBarShown === 'true') {
           // searchForm.classList.add('show');
           // searchBtnIcon.classList.replace('bx-search', 'bs-x');
        }

        const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

        sideLinks.forEach(item => {
            const li = item.parentElement;
            item.addEventListener('click', () => {
                sideLinks.forEach(i => {
                    i.parentElement.classList.remove('active');
                });
                li.classList.add('active');
            });
        });

        const menuBar = document.querySelector('.content nav .bx.bx-menu');

        menuBar.addEventListener('click', () => {
            sideBar.classList.toggle('close');

            // Store the state of the sidebar in local storage
            localStorage.setItem('sidebarClosed', sideBar.classList.contains('close'));
        });

     //   const searchBtn = document.querySelector('.content nav form .form-input button');

    /*    searchBtn.addEventListener('click', function (e) {
            if (window.innerWidth > 768) {
                e.preventDefault();
                searchForm.classList.toggle('show');
                if (searchForm.classList.contains('show')) {
                    searchBtnIcon.classList.replace('bx-search', 'bs-x');
                } else {
                    searchBtnIcon.classList.replace('bx-x', 'bx-search');
                }
            }

            // Store the state of the search bar in local storage
            localStorage.setItem('searchBarShown', searchForm.classList.contains('show'));
        });*/

        // Your existing code for the theme toggle
        const toggler = document.getElementById('theme-toggle');

        toggler.addEventListener('change', function () {
            if (this.checked) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
        });



/*333333333333333333333333333*/

/*

document.addEventListener('DOMContentLoaded', function () {
    const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');
    const sideBar = document.querySelector('.sidebar');

    // Check if the side menu state is stored in localStorage
    const isSideMenuClosed = localStorage.getItem('isSideMenuClosed') === 'true';

    if (isSideMenuClosed) {
        sideBar.classList.add('close');
    }

    sideLinks.forEach(item => {
        const li = item.parentElement;
        item.addEventListener('click', () => {
            sideLinks.forEach(i => {
                i.parentElement.classList.remove('active');
            });
            li.classList.add('active');
        });
    });

    const menuBar = document.querySelector('.content nav .bx.bx-menu');
    menuBar.addEventListener('click', () => {
        sideBar.classList.toggle('close');

        // Store the state in localStorage
        localStorage.setItem('isSideMenuClosed', sideBar.classList.contains('close'));
    });

    const searchBtn = document.querySelector('.content nav form .form-input button');
    const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
    const searchForm = document.querySelector('.content nav form');

    searchBtn.addEventListener('click', function (e) {
        if (window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if (searchForm.classList.contains('show')) {
                searchBtnIcon.classList.replace('bx-search', 'bs-x');
            } else {
                searchBtnIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth < 768) {
            sideBar.classList.add('close');
        } else {
            sideBar.classList.remove('close');
        }

        if (window.innerWidth > 576) {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });

    const toggler = document.getElementById('theme-toggle');

    toggler.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    });
});
*/