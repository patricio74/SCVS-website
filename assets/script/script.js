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

//view login password
function togglePasswordVisibility() {
  var passwordInput = document.querySelector('input[name="password"]');
  var showPassCheckbox = document.getElementById('showPass');

  if (showPassCheckbox.checked) {
    passwordInput.type = 'text';
  } else {
    passwordInput.type = 'password';
  }
}

//regform pass
function toggleRegPass() {
  var passwordInput = document.getElementsByName("pass")[0];
  var showPasswordCheckbox = document.getElementById("showPass");

  if (showPasswordCheckbox.checked) {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}

// Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon
function navbarr() {
  var x = document.getElementById("navbarr");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

// result page print button
function printPage() {
  var style = document.createElement('style');
  style.innerHTML = '@page { size: landscape; }';
  document.head.appendChild(style);
  window.print();
}

//para isang checkbox lang maselect per fieldset
function handleCheckboxSelection(checkbox) {
  const fieldset = checkbox.parentNode.parentNode;
  const checkboxes = fieldset.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(function(cb) {
      if (cb !== checkbox) {
          cb.checked = false;
      }
  });
}