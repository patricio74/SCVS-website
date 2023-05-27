<!--
    Perez, John Patrick A.
    BSIT-3F
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1A.0">
    <title>Registration form - SCVS</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Load hamburger icon kapag nasa mobile -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./assets/css/register.css">
</head>
<body>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $middle_name = $_POST['middle_name'];
      $course = $_POST['course'];
      $year = $_POST['year'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $phone_number = $_POST['phone_number'];

      $servername = "db4free.net";
      $username = "scvsystem";
      $password = "scvsystemprz23";
      $dbname = "scvs_perez";

      try {
          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
              throw new Exception("Connection failed: " . $conn->connect_error);
          }

          $sql = "INSERT INTO student (firstname, lastname, middlename, course, yrsec, email, pword, phone_number)
                  VALUES ('$first_name', '$last_name', '$middle_name', '$course', '$year', '$email', '$pass', '$phone_number')";

          if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href = 'reg_success.php';</script>";
            exit();
        } else {
              throw new Exception("Error: " . $sql . "<br>" . $conn->error);
          }

          $conn->close();
      } catch (Exception $e) {
          echo "Error: " . $e->getMessage();
      }
  }
  ?>
    <div class="topnav" id="navbarr">
        <a href="index.php" class="active">SCVS</a>
        <a href="candidates.php">Candidates</a>
        <a href="result.php">Result</a>
        <a href="about.php">About</a>
        <a href="javascript:void(0);" class="icon" onclick="navbarr()">
            <i class="fa fa-bars"></i>
        </a>
    </div>    
    <!--reg form-->
    <form class="form" method="post">
      <img src="assets/images/icon92px.png" alt="icon" class="iconLogin">
      <!--<p style="text-align: center;">Make your voice heard.</p>-->
      <p class="formTitle">Register to SCVS now!</p>

      <input type="text" placeholder="FIRST NAME" class="input" id="first_name" name="first_name" oninput="this.value = this.value.toUpperCase()" required>
      
      <input type="text" placeholder="MIDDLE NAME" class="input" id="middle_name" name="middle_name" oninput="this.value = this.value.toUpperCase()" required>

      <input type="text" placeholder="LAST NAME" class="input" id="last_name" name="last_name" oninput="this.value = this.value.toUpperCase()" required>

      <select placeholder="Course" class="input" name="course" id="course" required>
        <option value="BS INFORMATION TECHNOLOGY">BS INFORMATION TECHNOLOGY</option>
        <option value="BS COMPUTER ENGINEERING">BS COMPUTER ENGINEERING</option>
        <option value="BS ELEMENTARY EDUCATION">BS ELEMENTARY EDUCATION</option>
        <option value="BS SECONDARY EDUCATION">BS SECONDARY EDUCATION</option>
        <option value="BS ENTREPRENEURSHIP">BS ENTREPRENEURSHIP</option>
        <option value="BS BUSINESS MANAGEMENT">BS BUSINESS MANAGEMENT</option>
      </select>

      <select placeholder="Year" class="input" name="year" id="year" required>
        <option value="1A">1A</option>
        <option value="1B">1B</option>
        <option value="1C">1C</option>
        <option value="1D">1D</option>
        <option value="1E">1E</option>
        <option value="1F">1F</option>
        <option value="2A">2A</option>
        <option value="2B">2B</option>
        <option value="2C">2C</option>
        <option value="2D">2D</option>
        <option value="2E">2E</option>
        <option value="2F">2F</option>
        <option value="3A">3A</option>
        <option value="3B">3B</option>
        <option value="3C">3C</option>
        <option value="3D">3D</option>
        <option value="3E">3E</option>
        <option value="3F">3F</option>
        <option value="4A">4A</option>
        <option value="4B">4B</option>
        <option value="4C">4C</option>
        <option value="4D">4D</option>
      </select>

      <input placeholder="phone number (+639081231234)" class="input" name="phone_number" pattern="(\+[0-9]{1,3})?[0-9]{10,12}" maxlength="13" required>

      <input placeholder="email address" class="input" type="text" name="email" oninput="this.value = this.value.toLowerCase()" required>

      <!--show password checkbox-->
      <input placeholder="password" class="input" type="password" name="pass" required>
      <span class="chckbox" onclick="toggleRegPass()">
        <input type="checkbox" id="showPass">
        <label for="showPass">show</label>
      </span>
        <button id="regBtn" type="submit">Register</button>
        <p id="registerText">Already have an account? Login
            <a href="index.php" id="registerLink">here</a>.
        </p>
    </form>
    <p style="min-height: 10vh;"></p>
    <script type="text/javascript" src="./assets/script/script.js"></script>
  </body>
</html>