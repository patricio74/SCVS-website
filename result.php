<!--
    Perez, John Patrick A.
    BSIT-3F
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vote Result - SCVS</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="candidates.css">
    </head>
    <body>
        <div class="topnav" id="navbarr">
                <a href="index.php" class="active">SCVS</a>
                <a href="candidates.html">Candidates</a>
          		  <a href="result.php">Result</a>
          		  <a href="about.html">About</a>
                <a href="javascript:void(0);" class="icon" onclick="navbarr()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <button id="printButton" onclick="printPage()">PRINT</button>

            <p class="page-title">Election result as of <span style="color: #daa520;"><?php date_default_timezone_set('Asia/Manila');
            echo date("g:i a");?>
            </p></span>
<!--<br>
            <p class="page-description">Voting result will be posted here after the election.</p>
-->
<?php
    try{
        $servername = "db4free.net";
        $username = "scvsystem";
        $password = "scvsystemprz23";
        $dbname = "scvs_perez";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //Array to hold the positions in the desired order
        $positions = array(
            "President", 
            "Vice President", 
            "Secretary", 
            "Treasurer", 
            "Auditor", 
            "Public Relations Officer", 
            "First year representative", 
            "Second year representative", 
            "Third year representative", 
            "Fourth year representative"
        );

        // Iterate over each position and display the corresponding table
        foreach ($positions as $position) {
            echo "<h3>$position</h3>";
            echo "<table>";
            echo "<tr><th>Candidate name</th><th>Vote count</th></tr>";

            $sql = "SELECT candidate.candid_name, COUNT(vote.vote_id) AS vote_count
                    FROM candidate
                    LEFT JOIN vote ON candidate.candid_id = vote.candid_id
                    WHERE candidate.candid_position = '$position'
                    GROUP BY candidate.candid_name";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $voteCount = $row["vote_count"];
                    $candidateName = $row["candid_name"];

                    echo "<tr><td>$candidateName</td><td>$voteCount</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No data available</td></tr>";
            }

            echo "</table>";
        }

        $conn->close();
    } catch (mysqli_sql_exception $e) {
        // Catch the exception and display a custom error message
        $errorMessage = "An error occurred while connecting to the database. Please try again later.";
        echo $errorMessage;
    }
    ?>
        <p style="min-height: 5vh;"></p>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>