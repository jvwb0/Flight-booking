<?php
session_start();
require '../assets/db.php';

// log in check same as evvvvvvvvery other file
if (empty($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// same damn sql block to get flight info shouldve made this a method lmao
$sql = "SELECT b.id, b.booked_at,
               al.name AS airline,
               a1.iata AS origin, a2.iata AS destination,
               f.depart_time, f.arrive_time, f.price
        FROM bookings b
        JOIN flights f   ON f.id = b.flight_id
        JOIN airlines al ON al.id = f.airline_id
        JOIN airports a1 ON a1.id = f.origin_airport_id
        JOIN airports a2 ON a2.id = f.destination_airport_id
        WHERE b.user_id = ?
        ORDER BY b.booked_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Bookings</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="main-view">
<header class="topbar">
  <div class="brand">
    <span class="brand-mark">✈️</span>
    <span class="brand-name">BSZ AIR</span>
  </div>
  <nav class="nav">
    <span class="nav-link">Hi, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
    <a class="nav-link" href="main.php">Find flights</a>
    <a class="nav-link strong" href="logout.php">Logout</a>
  </nav>
</header>

<h1 class="title" style="text-align:center; color:#d36b00;">My Bookings</h1>

<main>
    <?php if (empty($bookings)): ?>
    <p style="text-align:center;">You have no bookings yet.</p>
  <?php else: ?>
    <table border="1" cellpadding="6" style="margin:auto; width:90%; border-collapse:collapse;">
      <tr style="background:#ff914d; color:white;">
        <th>#</th>
        <th>Airline</th>
        <th>From</th>
        <th>To</th>
        <th>Depart</th>
        <th>Arrive</th>
        <th>Price (€)</th>
        <th>Booked at</th>
      </tr>
      <?php foreach ($bookings as $b): ?>
        <tr style="background:#fffaf6;">
          <td><?= $b['id'] ?></td>
          <td><?= htmlspecialchars($b['airline']) ?></td>
          <td><?= htmlspecialchars($b['origin']) ?></td>
          <td><?= htmlspecialchars($b['destination']) ?></td>
          <td><?= htmlspecialchars($b['depart_time']) ?></td>
          <td><?= htmlspecialchars($b['arrive_time']) ?></td>
          <td><?= htmlspecialchars($b['price']) ?></td>
          <td><?= htmlspecialchars($b['booked_at']) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
  <a href="./download_ticket.php">Download Ticket (PDF)</a>

</main>

<footer class="footer">
  <small>© BSZ AIR — made for a school project</small>
</footer>
</body>
</html>