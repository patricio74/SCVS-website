<?php
session_start();
session_destroy(); // delete cookiez

header('Location: index.php');
exit;
?>