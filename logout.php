<?php
session_start(); // start the session
session_destroy(); // destroy all data registered to a session

// redirect to the login page
header('Location: index.php');
exit;
?>