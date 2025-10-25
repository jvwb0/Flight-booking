<?php
session_start();

if (isset($_SESSION['username']))
{
    echo "You are logged in as " . $_SESSION['username'] . "<br>";
    echo "<a href='logout.php'>Logout</a><br><br>";

    echo "<a href='search.php'>Search flights</a><br>";
    echo "<a href='my_bookings.php'>My bookings</a>";
}
else
{
    echo "You are not logged in.<br>";
    echo "<a href='login.php'>Login</a>";
}
?>