/**
 * Perez, John Patrick A.
 * BSIT-3F
 */

/*
function toggleTheme() {
    var element = document.body;
    element.classList.toggle("dark-mode");
 }
*/

//pangview ng password
 function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function navbarr() {
  var x = document.getElementById("navbarr");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
