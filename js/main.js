const html = document.querySelector('html');
if (window.localStorage.getItem("dark-mode")==="yes"){
   html.classList.add("dark-theme");
}

/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/* Menu show */
navToggle.addEventListener('click', () =>{
   navMenu.classList.add('show-menu')
})

/* Menu hidden */
navClose.addEventListener('click', () =>{
   navMenu.classList.remove('show-menu')
})

/*=============== SEARCH ===============*/
const search = document.getElementById('search'),
      searchBtn = document.getElementById('search-btn'),
      searchClose = document.getElementById('search-close')

/* Search show */
searchBtn.addEventListener('click', () =>{
   search.classList.add('show-search')
})

/* Search hidden */
searchClose.addEventListener('click', () =>{
   search.classList.remove('show-search')
})

/*=============== LOGIN ===============*/
const login = document.getElementById('login'),
      loginBtn = document.getElementById('login-btn'),
      loginClose = document.getElementById('login-close')

/* Login show */
loginBtn.addEventListener('click', () =>{
   login.classList.add('show-login')
})

/* Login hidden */
loginClose.addEventListener('click', () =>{
   login.classList.remove('show-login')
})
function reverse(){
   let revToggle = document.querySelector(".toggle");
   const html = document.querySelector('html');
   revToggle.classList.toggle("toggle-reversed");
   if(html.classList.toggle("dark-theme")){
      window.localStorage.setItem("dark-mode","yes");
   }
   else{
      window.localStorage.removeItem("dark-mode");
   }
}
function toggleMenu(){
   let dropDown = document.querySelectorAll("#dropDown");
   dropDown.forEach(function(dropDown) {
   dropDown.classList.toggle("open-menu");
   });
}

// temporary message
document.addEventListener("DOMContentLoaded", function() {
   const messageContainer = document.getElementById('message-container');
   const messageDuration = 3000; // 5 minutes in milliseconds

   // Show the message
   messageContainer.classList.remove('hidden');
   
   // Hide the message after a certain duration
   setTimeout(function() {
       messageContainer.classList.add('hidden');
   }, messageDuration);
});
