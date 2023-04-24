<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1A.0">
    <title>Registration form -SCVS</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="voting.css">
</head>
<body>
    <h1>Registration Form</h1>
    <?php
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve the form data from $_POST array
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $middle_name = $_POST['middle_name'];
      $course = $_POST['course'];
      $year = $_POST['year'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Connect to the database
      $servername = "db4free.net";
      $username = "patricc";
      $password = "votingsystem";
      $dbname = "voting_system";

      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Prepare the SQL query
      $sql = "INSERT INTO voters (First_name, Last_name, Middle_name, Course, Yr, Email, Pass)
              VALUES ('$first_name', '$last_name', '$middle_name', '$course', '$year', '$email', '$password')";

      // Execute the query
      if ($conn->query($sql) === TRUE) {
        echo "New voter created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      // Close the database connection
      $conn->close();
    }
    ?>
    <form method="post">
      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" oninput="this.value = this.value.toUpperCase()" required><br>

      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" oninput="this.value = this.value.toUpperCase()" required><br>

      <label for="middle_name">Middle Name:</label>
      <input type="text" id="middle_name" name="middle_name" oninput="this.value = this.value.toUpperCase()" required><br>

      <label for="course">Course:</label>
      <select name="course" id="course">
        <option value="BS INFORMATION TECHNOLOGY">BS INFORMATION TECHNOLOGY</option>
        <option value="BS COMPUTER ENGINEERING">BS COMPUTER ENGINEERING</option>
        <option value="BS ELEMENTARY EDUCATION">BS ELEMENTARY EDUCATION</option>
        <option value="BS SECONDARY EDUCATION">BS SECONDARY EDUCATION</option>
        <option value="BS ENTREPRENEURSHIP">BS ENTREPRENEURSHIP</option>
        <option value="BS BUSINESS MANAGEMENT">BS BUSINESS MANAGEMENT</option>
      </select><br>

      <label for="year">Year:</label>
      <select name="year" id="year">
        <option value="1A">1A</option>
        <option value="1B">1B</option>
        <option value="1C">1C</option>
        <option value="1D">1D</option>
        <option value="2A">2A</option>
        <option value="2B">2B</option>
        <option value="2C">2C</option>
        <option value="2D">2D</option>
        <option value="3A">3A</option>
        <option value="3B">3B</option>
        <option value="3C">3C</option>
        <option value="3D">3D</option>
        <option value="4A">4A</option>
        <option value="4B">4B</option>
        <option value="4C">4C</option>
        <option value="4D">4D</option>
      </select><br>


      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br>

      <label for="password">Password:</label>
      <div style="position: relative;">
        <input type="password" id="password" name="password" required>
        <button type="button" style="position: absolute; top: 8px; right: 5px;" onclick="showPassword()">Show</button>
      </div>
      <input type="submit" value="Register">
    </form>
    <button onclick="window.location.href='index.php'">Cancel</button>
    <script type="text/javascript" src="script.js"></script>
  </body>
</html>