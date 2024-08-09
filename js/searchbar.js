// Object mapping options to URLs
const optionLinks = {
    "Home": "../html/HomePage.php",
    "Gestion Entités": "../html/HomePageTabGentite.php",
    "Gestion Personnel": "../html/HomePageTabGper.php",
    "Gestion Puces": "../html/HomePageTabGpuce.php",
    "Affectation Puces": "../html/HomePageTabAffpuce.php",
    "Gestion Dotation": "../html/HomePageTabGdotation.php",
    "Gestion User": "../html/HomePageTabGuser.php",
    "Reporting": "../html/HomePageTabReporting.php"
 };
 
 // Function to handle the redirection
 function handleRedirection() {
    const input = document.getElementById('search-input');
    const selectedOption = input.value;
    if (optionLinks[selectedOption]) {
        window.location.href = optionLinks[selectedOption];
    }
 }
 
 // Add event listener to input field
 document.getElementById('search-input').addEventListener('change', handleRedirection);
 
 // Optionally handle form submission to prevent default action
 document.querySelector('.search__form').addEventListener('submit', function(e) {
    e.preventDefault();
    handleRedirection();
 });