function toggleTheme() {
    var element = document.body;
    element.classList.toggle("dark-mode");
 }

 function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

