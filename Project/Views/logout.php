<?php
session_start();
$_SESSION = array();
session_destroy();
echo "You are logged out.<br>";
echo "<a href='login.php'>Back to login</a>";
?>