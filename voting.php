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
    <title>Voting form -SCVS</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./assets/css/voting.css">
</head>
<body>
  <h1>STUDENT COUNCIL VOTING</h1>
	<form method="post" action="submit_vote.php">
  <?php
        $servername = "db4free.net";
        $username = "scvsystem";
        $password = "scvsystemprz23";
        $dbname = "scvs_perez";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $candidatePositions = array(
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

        $query = "SELECT * FROM candidate";
        $result = mysqli_query($conn, $query);

        $candidatesByPosition = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $candidId = $row['candid_id'];
            $candidName = $row['candid_name'];
            $candidPosition = $row['candid_position'];

            $candidatesByPosition[$candidPosition][] = array(
                'id' => $candidId,
                'name' => $candidName
            );
        }

        foreach ($candidatePositions as $position) {
            if (isset($candidatesByPosition[$position])) {
                echo '<div class="box">';
                echo '<h2>' . $position . '</h2>';

                foreach ($candidatesByPosition[$position] as $candidate) {
                    $candidId = $candidate['id'];
                    $candidName = $candidate['name'];
                    echo '<input type="radio" name="' . $position . '" value="' . $candidId . '">' . $candidName . '<br>';
                }
                echo '</div>';
            }
        }

        mysqli_close($conn);
        ?>
    <input type="submit" id="submitBtn" name="submit" value="Submit Vote">
	</form>
  <a href="logout.php">
    Click here to cancel voting and logout.
  </a>
  <script type="text/javascript" src="script.js"></script>
</body>
</html>