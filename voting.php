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
        <link rel="stylesheet" href="voting.css">
</head>
<body>
  <h1>STUDENT COUNCIL VOTING</h1>
	<form method="post" action="submit_vote.php">
		<h2>President</h2>
		<input type="radio" name="president" value="Juanito Santos">Juanito Santos<br>
		<input type="radio" name="president" value="Maria Cruz">Maria Cruz<br>
		<input type="radio" name="president" value="Eduardo Reyes">Eduardo Reyes<br>

		<h2>Vice President</h2>
		<input type="radio" name="vice_president" value="Rosario Garcia">Rosario Garcia<br>
		<input type="radio" name="vice_president" value="Ferdinand Lim">Ferdinand Lim<br>
		<input type="radio" name="vice_president" value="Ysabel Rivera">Ysabel Rivera<br>

    <input type="submit" name="submit" value="Submit">
	</form>
<br>
	<!-- Logout button -->
  <form style="display:inline-block;" action="logout.php" method="post">
    <input type="submit" name="logout" value="Logout">
  </form>
  <script type="text/javascript" src="script.js"></script>
</body>
</html>
