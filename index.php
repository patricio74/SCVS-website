<!--
    Perez, John Patrick A.
    BSIT-3F
-->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $user_password = $_POST['password'];

  $servername = "db4free.net";
  $username = "scvsystem";
  $password = "scvsystemprz23";
  $dbname = "scvs_perez";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT * FROM student WHERE email = ? AND pword = ?");
  $stmt->bind_param("ss", $email, $user_password);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $_SESSION['student'] = $row;
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['user_id'];

    if ($_SESSION['student']['votestatus'] === 'voted') {
      echo "<script>window.location.href = 'errr.php';</script>";
      exit;
    } else {
      echo "<script>window.location.href = 'voting.php';</script>";
      exit;
    }
  } else {
    $error = "Invalid email or password.";
    session_destroy();
    echo "<p>Please check your email/password and login again.</p>";
    echo "<form action='index.php'><button type='submit'>Return</button></form>";
    exit;
  }
  
  $stmt->close();  
  $conn->close();
}
?>

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
        <!-- Load hamburger icon kapag nasa mobile -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./assets/css/style.css">
    </head>
    <body>
        <div class="topnav" id="navbarr">
            <a href="index.php" class="active">SCVS</a>
            <a href="candidates.php">Candidates</a>
            <a href="result.php">Result</a>
            <a href="about.php">About</a>
            <a href="javascript:void(0);" class="icon" onclick="navbarr()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <!--login form-->
        <form class="form" method="post">
            <img src="assets/images/icon92px.png" alt="icon" class="iconLogin">
            <p class="formTitle">Welcome to SCVS website!</p>
            <input placeholder="Email address" class="input" type="text" name="email" required>
            <input placeholder="Password" class="input" type="password" id="password" name="password" required> 
      <span class="chckbox" onclick="togglePasswordVisibility()">
        <input type="checkbox" id="showPass">
        <label for="showPass">show</label>
      </span>
            <button id="loginBtn" type="submit">Login</button>
                <p id="registerText">Don't have account yet? Register
                    <a href="register.php" id="registerLink">here</a>.
                </p>
        </form>
        <script type="text/javascript" src="./assets/script/script.js"></script>
    </body>
</html>