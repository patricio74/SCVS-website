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
$secretary = $_POST['secretary'];
$treasurer = $_POST['treasurer'];
$auditor = $_POST['auditor'];
$Public_Relations_Officer = $_POST['Public_Relations_Officer'];
$First_Year_Representative = $_POST['First_Year_Representative'];
$Second_Year_Representative = $_POST['Second_Year_Representative'];
$Third_Year_Representative = $_POST['Third_Year_Representative'];
$Fourth_Year_Representative = $_POST['Fourth_Year_Representative'];

// Determine the correct position values based on the selected radio buttons
$president_position = '';
$vice_president_position = '';
$secretary_position = '';
$treasurer_position = '';
$auditor_position = '';
$PRO_position = '';
$First_Year_position = '';
$Second_Year_position = '';
$Third_Year_position = '';
$Fourth_Year_position = '';

if ($president == 'Juanito Santos' || $president == 'Maria Cruz' || $president == 'Eduardo Reyes') {
    $president_position = 'President';
}

if ($vice_president == 'Rosario Garcia' || $vice_president == 'Ferdinand Lim' || $vice_president == 'Ysabel Rivera') {
    $vice_president_position = 'Vice President';
}

if ($secretary == 'Benigno Tan' || $secretary == 'Victoria Reyes' || $secretary == 'Rafaela Villanueva') {
    $secretary_position = 'Secretary';
}

if ($treasurer == 'Josefa Alcantara' || $treasurer == 'Emilio Ramos' || $treasurer == 'Consuelo Cruz') {
    $treasurer_position = 'Treasurer';
}

if ($auditor == 'Marcelo Mercado' || $auditor == 'Paz Herrera' || $auditor == 'Ramonito Cruz') {
    $auditor_position = 'Auditor';
}

if ($Public_Relations_Officer == 'Trinidad Lopez' || $Public_Relations_Officer == 'Marcelina Reyes' || $Public_Relations_Officer == 'Ricardo de la Cruz') {
    $PRO_position = 'Public Relations Officer';
}

if ($First_Year_Representative == 'Romulo Rodriguez' || $First_Year_Representative == 'Esperanza Gonzales' || $First_Year_Representative == 'Felipe Cruz') {
    $First_Year_position = 'First Year Representative';
}

if ($Second_Year_Representative == 'Ana Luna' || $Second_Year_Representative == 'Gregorio Santos' || $Second_Year_Representative == 'Aurora Reyes') {
    $Second_Year_position = 'Second Year Representative';
}

if ($Third_Year_Representative == 'Manuelito Cruz' || $Third_Year_Representative == 'Lourdes de la Cruz' || $Third_Year_Representative == 'Rodrigo Flores') {
    $Third_Year_position = 'Third Year Representative';
}

if ($Fourth_Year_Representative == 'Gloria Sanchez' || $Fourth_Year_Representative == 'Domingo Abad' || $Fourth_Year_Representative == 'Angelita Sarmiento') {
    $Fourth_Year_position = 'Fourth Year Representative';
}

// Check if user has already voted
$sql = "SELECT * FROM voters WHERE email='$email' AND votestatus='voted'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "You have already voted!";
    exit();
} else {
    // Insert the vote into the database and update the voter's vote status
    $query = "INSERT INTO candidates (full_name, position) 
    VALUES ('$president', '$president_position'),
    ('$vice_president', '$vice_president_position'),
    ('$secretary', '$secretary_position'),
    ('$treasurer', '$treasurer_position'),
    ('$auditor', '$auditor_position'),
    ('$Public_Relations_Officer', '$PRO_position'),
    ('$First_Year_Representative', '$First_Year_position'),
    ('$Second_Year_Representative', '$Second_Year_position'),
    ('$Third_Year_Representative', '$Third_Year_position'),
    ('$Fourth_Year_Representative', '$Fourth_Year_position')";

    $query = "UPDATE voters SET votestatus = 'voted' WHERE email = '$email'";
    if (mysqli_query($conn, $query)) {
        // Success message and redirection
        header("Location: vote_success.html");
        exit;
    } else {
        echo "<script>alert('Error submitting your vote!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
}
mysqli_close($conn);
?>
