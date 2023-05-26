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
        <title>Candidates - SCVS</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Load hamburger icon kapag nasa mobile -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./assets/css/candidates.css">
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
            <button id="printButton" onclick="printPage()">PRINT</button>
            <p style="min-height: 3vh;"></p>
            <h1 class="page-title">Student Council Candidates</h1>            
        <?php
            $servername = "db4free.net";
            $username = "scvsystem";
            $password = "scvsystemprz23";
            $dbname = "scvs_perez";

            try{
                $conn = new mysqli($servername, $username, $password, $dbname);
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
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
        
            // Query to retrieve data from the table
            $sql = "SELECT * FROM candidate";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $tables = array(); // Array to store tables
        
                // Initialize tables for each position
                foreach ($positions as $position) {
                    $tables[$position] = array();
                }
        
                // Loop through each row of the result
                while ($row = $result->fetch_assoc()) {
                    $position = $row["candid_position"];
        
                    // Add candidate ID and name to the respective position's table
                    $tables[$position][] = array($row["candid_id"], $row["candid_name"]);
                }
        
                // Display tables for each position in the specified order
                foreach ($positions as $position) {
                    $candidates = $tables[$position];
        
                    // Skip positions with no candidates
                    if (empty($candidates)) {
                        continue;
                    }
        
                    echo "<h3>$position</h3>";
                    echo "<table>";
                    echo "<tr><th>Candidate ID</th><th>Candidate Name</th></tr>";
        
                    // Display candidate data in the table
                    foreach ($candidates as $candidate) {
                        echo "<tr><td>".$candidate[0]."</td><td>".$candidate[1]."</td></tr>";
                    }
        
                    echo "</table>";
                }
            } else {
                echo "No data found in the table.";
            }
            
            $conn->close();
            } catch (mysqli_connect_error $e) {
                $errorMessage = "An error occurred while connecting to the database. Please try again later.";
                echo $errorMessage;
            }
            
        ?>
        <p style="min-height: 5vh;"></p>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>