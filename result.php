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
$sql = "SELECT COUNT(*) AS vote_count, full_name, position FROM candidates GROUP BY full_name, position ORDER BY FIELD(position, 'President', 'Vice President', 'Secretary', 'Treasurer', 'Auditor', 'Public Relations Officer', '1st yr representative', '2nd yr representative', '3rd yr representative', '4th yr representative'), full_name";
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
        <link rel="stylesheet" href="voting.css">
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
<!--<br>
            <p class="page-title">No result yet!</p>
            <p class="page-description">Voting result will be posted here after the election.</p>
-->
        <table>
        <tr>
            <th>Vote Count</th>
            <th>Candidate</th>
            <th>Position</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row["vote_count"]; ?></td>
            <td><?php echo $row["full_name"]; ?></td>
            <td><?php echo $row["position"]; ?></td>
        </tr>
        <?php } ?>
        </table>
        <p style="min-height: 65vh;"></p>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>
<?php
// Close database connection
mysqli_close($conn);
?>