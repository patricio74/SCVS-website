<!--
    Perez, John Patrick A.
    BSIT-3F
-->
<?php
// Connect to database
$servername = "db4free.net";
$username = "patricc";
$password = "votingsystem";
$dbname = "voting_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve vote count, candidate name, and position from database
$sql = "SELECT COUNT(*) AS vote_count, full_name, position FROM candidates 
        GROUP BY full_name, position 
        ORDER BY FIELD(position, 'President', 'Vice President', 'Secretary', 'Treasurer',
         'Auditor', 'Public Relations Officer', '1st yr representative', '2nd yr representative',
          '3rd yr representative', '4th yr representative') ASC, 
            FIELD(position, 'President') DESC,
                position ASC,
                full_name ASC";
$result = mysqli_query($conn, $sql);
?>
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
            <p class="page-title">Election result as of <span style="color: #daa520;"><?php date_default_timezone_set('Asia/Manila');
            echo date("g:i a");?>
            </p></span>
<!--<br>
            <p class="page-description">Voting result will be posted here after the election.</p>
-->
            <?php
            // Create separate tables for each position
            $positions = array(); // Array to store unique positions

            // Group results by position
            while ($row = mysqli_fetch_assoc($result)) {
                $position = $row['position'];
                $positions[$position][] = $row;
            }

            // Generate tables for each position
            foreach ($positions as $position => $candidates) {
                echo '<h3>' . $position . '</h3>';
                echo '<table>';
                echo '<tr>
                        <th>Votes</th>
                        <th>Candidate</th>
                        <th>Position</th>
                    </tr>';

                foreach ($candidates as $candidate) {
                    echo '<tr>
                            <td>' . $candidate['vote_count'] . '</td>
                            <td>' . $candidate['full_name'] . '</td>
                            <td>' . $candidate['position'] . '</td>
                        </tr>';
                }

                echo '</table>';
            }
            ?>
        <p style="min-height: 5vh;"></p>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>
<?php
// Close database connection
mysqli_close($conn);
?>