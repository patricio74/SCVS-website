<?php
session_start();

$servername = "db4free.net";
$username = "patricc";
$password = "votingsystem";
$dbname = "voting_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get user email from session
$email = $_SESSION['email'];

// Get candidate names from voting page
$president = $_POST['president'];
$vice_president = $_POST['vice_president'];

// Determine the correct position values based on the selected radio buttons
if ($president == 'Juanito Santos') {
    $president_position = 'President';
} else if ($president == 'Maria Cruz') {
    $president_position = 'President';
} else if ($president == 'Eduardo Reyes') {
    $president_position = 'President';
}

if ($vice_president == 'Rosario Garcia') {
    $vice_president_position = 'Vice President';
} else if ($vice_president == 'Ferdinand Lim') {
    $vice_president_position = 'Vice President';
} else if ($vice_president == 'Ysabel Rivera') {
    $vice_president_position = 'Vice President';
}

// Check if user has already voted
$sql = "SELECT * FROM voters WHERE email='$email' AND  votestatus='voted'";
$result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    echo "You have already voted!";
    exit();
    }
    else {
    // Insert the vote into the database and update the voter's vote status
    $query = "INSERT INTO candidates (full_name, position) VALUES ('$president', '$president_position'), ('$vice_president', '$vice_president_position')";
    $query = "UPDATE voters SET votestatus = 'voted' WHERE email = '$email';";
        if (mysqli_multi_query($conn, $query)) {
        echo "<script>alert('Vote submitted successfully! Click ok to return to login page.');</script>";
        echo "<script>window.location.href='index.php';</script>";
        } else {
        echo "<script>alert('Error submitting vote!');</script>";
        echo "<script>window.location.href='index.php';</script>";
        }
    }
mysqli_close($conn);
?>
