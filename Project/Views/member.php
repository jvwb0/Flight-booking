<?php
session_start();

if (!isset($_SESSION['username']))
{ 
    header("Location: login.php");
     exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><title>Member</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <main class="card">
    <h1 class="title">Hi, <?php echo $_SESSION['username']; ?></h1>
    <p class="sub">Choose an action:</p>
    <p>
        <!-- I would love to have the member still be 
         logged in when redirected to the home page !-->
      <a class="link" href="main.php">Find flights</a> |
      <a class="link" href="my_bookings.php">My bookings</a> |
      <a class="link" href="logout.php">Logout</a>
    </p>
  </main>
</body>
</html>