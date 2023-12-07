let menu =document.querySelector("#menu-btn");
let menuIcon = document.querySelector("#menu-btn .bx");
let navbar = document.querySelector(".header .navbar");

menu.onclick =() =>{
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}

window.onscroll =() =>{
    menuIcon.classList.remove('bx-x');
    navbar.classList.remove('active');

}