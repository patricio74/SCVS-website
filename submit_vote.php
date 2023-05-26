<?php
session_start();

$servername = "db4free.net";
$username = "scvsystem";
$password = "scvsystemprz23";
$dbname = "scvs_perez";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];

$positions = array(
    "PRESIDENT",
    "VICE PRESIDENT",
    "SECRETARY",
    "TREASURER",
    "AUDITOR",
    "PUBLIC RELATIONS OFFICER",
    "FIRST YEAR REPRESENTATIVE",
    "SECOND YEAR REPRESENTATIVE",
    "THIRD YEAR REPRESENTATIVE",
    "FOURTH YEAR REPRESENTATIVE"
);

$selectedCandidates = array();

foreach ($positions as $position => $radioButtonName) {
    if (isset($_POST[$radioButtonName])) {
        $candidateName = $_POST[$radioButtonName];
        $selectedCandidates[] = array(
            'name' => $candidateName,
            'position' => $position
        );
    }
}

$sql = "SELECT * FROM student WHERE email='$email' AND votestatus='voted'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "You have already voted!";
    exit();
} else {
    // Retrieve the email value from the session
    $email = $_SESSION['email'];

    // Prepare the query using a parameterized statement
    $getUserIDQuery = "SELECT user_id FROM student WHERE email = ?";
    $stmt = mysqli_prepare($conn, $getUserIDQuery);
    
    // Bind the email parameter to the prepared statement
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Bind the result to variables
    mysqli_stmt_bind_result($stmt, $userID);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);
}

    foreach ($selectedCandidates as $candidate) {
        $candidateName = mysqli_real_escape_string($conn, $candidate['name']);
        $position = mysqli_real_escape_string($conn, $candidate['position']);

        $getCandidateIDQuery = "SELECT candid_id FROM candidate WHERE candid_name='$candidateName' AND candid_position='$position'";
        $candidateResult = mysqli_query($conn, $getCandidateIDQuery);

        if (!$candidateResult) {
            echo "Error retrieving candidate ID: " . mysqli_error($conn);
            exit();
        }

        if (mysqli_num_rows($candidateResult) > 0) {
            $candidateData = mysqli_fetch_assoc($candidateResult);
            $candidateID = $candidateData['candid_id'];

            if (!empty($candidateID)) {
                $insertVoteQuery = "INSERT INTO vote (candid_id, user_id) VALUES ('$candidateID', '$userID')";

                if (!mysqli_query($conn, $insertVoteQuery)) {
                    echo "Error: " . $insertVoteQuery . "<br>" . mysqli_error($conn);
                    exit();
                }
            } else {
                echo "Error retrieving candidate ID for: $candidateName ($position)";
                exit();
            }
        } else {
            echo "Error retrieving candidate ID for: $candidateName ($position)";
            exit();
        }

    }

    $updateQuery = "UPDATE student SET votestatus = 'voted' WHERE email = '$email'";

    if (!mysqli_query($conn, $updateQuery)) {
        echo "Error: " . $updateQuery . "<br>" . mysqli_error($conn);
        exit();
    }

    header("Location: vote_success.php");
    exit();

mysqli_close($conn);
?>
