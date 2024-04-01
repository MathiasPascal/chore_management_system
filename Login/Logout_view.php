<?php
session_start();

// Unset the session variables
$_SERVER = array();
// Redirect to the login_view page
header("Location: login_view.php");
exit();
?>
