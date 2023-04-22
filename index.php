<!--
    Perez, John Patrick A.
    BSIT-3F
-->
<?php
// Start a session to store user data
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get form input values
  $email = $_POST['email'];
  $user_password = $_POST['password'];

  // Connect to database
  $servername = "db4free.net";
  $username = "patricc";
  $password = "votingsystem";
  $dbname = "voting_system";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare SQL statement to select user with matching email and password
  $stmt = $conn->prepare("SELECT * FROM voters WHERE email = ? AND pass = ?");
  $stmt->bind_param("ss", $email, $user_password);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if a user was found
  if ($result->num_rows === 1) {
    // Store user data in session
    $_SESSION['user'] = $result->fetch_assoc();

    // Redirect to voting page
    header("Location: candidates.html");
    exit;
  } else {
    // Display error message
    echo "Invalid email or password.";
  }

  // Close database connection
  $stmt->close();
  $conn->close();
}
?>
        
<!-- Display an error message if there is one -->
<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SCVS Login</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="topnav" id="navbarr">
            <a href="index.html" class="active">SCVS</a>
            <a href="candidates.html">Candidates</a>
            <a href="#candidates">Result</a>
            <a href="about.html">About</a>
            <a href="javascript:void(0);" class="icon" onclick="navbarr()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <!--login form-->
        <?php include "login.php"; ?>
        <form class="form" method="post" action="login.php">
            <img src="assets/images/icon92px.png" alt="icon" class="iconLogin">
            <p class="formTitle">Welcome to SCVS website!</p>
            <input placeholder="Email address" class="input" type="text" name="email">
            <input placeholder="Password" class="input" type="password" id="password" name="password"> 
            <!--show password checkbox-->
            <label for="showPass" class="checkbox">
              <input type="checkbox" id="showPass" onclick="showPassword()">
              <span class="showPass">show</span>
            </label>
            <button id="loginBtn" type="submit">Log in</button>
                <p id="registerText">Don't have account yet? Register
                    <a href="#register" id="registerLink">here</a>.
                </p>
        </form>

        <script type="text/javascript" src="script.js"></script>
    </body>
</html>