<?php
// Start a session to store user data
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form input values
  $email = $_POST['email'];
  $password = $_POST['password'];

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
  $stmt->bind_param("ss", $email, $password);
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
