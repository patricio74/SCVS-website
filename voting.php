<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "db4free.net";
$username = "scvsystem";
$password = "scvsystemprz23";
$dbname = "scvs_perez";

$conn = mysqli_connect($servername, $username, $password, $dbname);
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["candidates"]) && !empty($_POST["candidates"])) {
        $selectedCandidates = $_POST["candidates"];

        $sessionUserId = $_SESSION['user_id'];
        $sql = "SELECT votestatus FROM student WHERE user_id = '$sessionUserId'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $votestatus = $row['votestatus'];

            if ($votestatus === 'voted') {
                header("Location: errr.php");
                exit();
            }

            foreach ($selectedCandidates as $candidId) {
                $sql = "INSERT INTO vote (user_id, candid_id) VALUES ('$sessionUserId', '$candidId')";
                $conn->query($sql);
            }

            $sql = "UPDATE student SET votestatus = 'voted' WHERE user_id = '$sessionUserId'";
            $conn->query($sql);

            header("Location: vote_success.php");
            exit();
        } else {
            echo "User not found.";
        }
    } else {
        echo "Please select a candidate before you submit.";
    }
}

$candidates = array();
$sql = "SELECT * FROM candidate ORDER BY candid_position";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidates[$row["candid_position"]][] = $row;
    }
}
?>

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
    <title>Voting form - SCVS</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/voting.css">
</head>

<body>
    <h1>STUDENT COUNCIL VOTE FORM</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php foreach ($positions as $position) : ?>
            <fieldset>
                <legend><?php echo $position; ?></legend>
                <?php if (isset($candidates[$position])) : ?>
                    <?php foreach ($candidates[$position] as $candidate) : ?>
                        <label>
                            <input type="checkbox" name="candidates[]" value="<?php echo $candidate['candid_id']; ?>" onclick="handleCheckboxSelection(this);">
                            <?php echo $candidate['candid_name']; ?>
                        </label><br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </fieldset><br>
        <?php endforeach; ?>
        <input type="submit" id="submitBtn" name="submit" value="Submit Vote">
    </form>
    <a href="logout.php">
        Click here to cancel voting and logout.
    </a>
    <script type="text/javascript" src="./assets/script/script.js"></script>
</body>
</html>
<?php
$conn->close();
?>
