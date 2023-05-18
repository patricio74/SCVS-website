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
  var passwordField = document.getElementById("password");
  var showButton = document.querySelector("#pass + button");

  if (passwordField.type === "password") {
    passwordField.type = "text";
    showButton.textContent = "Hide";
  } else {
    passwordField.type = "password";
    showButton.textContent = "Show";
  }
  }

  //register form password
  function togglePasswordVisibility() {
    var passwordInput = document.querySelector('input[name="pass"]');
    var showPassCheckbox = document.getElementById('showPass');
    
    if (showPassCheckbox.checked) {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
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

/* result page print button*/
function printPage() {
  var style = document.createElement('style');
  style.innerHTML = '@page { size: landscape; }';
  document.head.appendChild(style);
  window.print();
}