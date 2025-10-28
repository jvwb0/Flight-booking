<?php
require '../assets/db.php';
session_start();
$airports  = $pdo->query("SELECT iata, name 
                          FROM airports 
                          ORDER BY iata");
$countries = $pdo->query("SELECT name 
                          FROM countries 
                          ORDER BY name");
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Find Flights</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="main-view">
  <!-- Top bar -->
  <header class="topbar">
    <div class="brand">
      <span class="brand-mark">✈️</span>
      <span class="brand-name">BSZ AIR</span>
    </div>
    <nav class="nav">
      <?php if (!empty($_SESSION['username'])): ?>
        <span class="nav-link">Hi, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
        <a class="nav-link" href="my_bookings.php">My bookings</a>
        <a class="nav-link strong" href="logout.php">Logout</a>
      <?php else: ?>  
        <a class="nav-link" href="login.php">Login</a>
        <a class="nav-link strong" href="register.php">Sign Up</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- Hero -->
  <section class="hero">
    <h1 class="hero-title">Your next trip starts here</h1>
    <p class="hero-sub">Warm destinations, simple booking.</p>
  </section>

<?php
$images = [
   "../assets/img/img3.jpg",
   "../assets/img/img2.jpg",
   "../assets/img/img4.jpg",
   "../assets/img/img1.jpg"
  ];
$pick = $images[array_rand($images)];   // https://stackoverflow.com/questions/1761252/how-to-get-random-image-from-directory-using-php
?>
<section class="banner">
  <img src="<?= $pick ?>" alt="Banner" class="banner-img">
</section>

  <!-- Flight Search -->
  <main class="card search-card">
    <h2 class="title" style="margin-bottom:12px;">Search Flights</h2>

    <form class="form search-form" method="get" action="results.php">
      <div class="row">
        <div class="field">
          <label class="label" for="from">From</label>
          <input class="input" id="from" name="from" type="text" list="places" placeholder="e.g., BER or Germany" required>
        </div>

        <div class="field">
          <label class="label" for="to">To</label>
          <input class="input" id="to" name="to" type="text" list="places" placeholder="e.g., MAD or Spain" required>
        </div>
      </div>

      <div class="row">
        <div class="field">
          <label class="label" for="depart">Depart</label>
          <input class="input" id="depart" name="depart" type="date">
        </div>

        <div class="field">
          <label class="label" for="return">Return (optional)</label>
          <input class="input" id="return" name="return" type="date">
        </div>
      </div>

      <button class="btn" type="submit">Search Flights</button>
    </form>

    <datalist id="places">              <!-- Datalist: https://www.w3schools.com/tags/tag_datalist.asp -->
      <?php
        while ($row = $airports->fetch())
        {
          echo "<option value='" . $row["iata"] . "'>" . $row["name"] . "</option>";
        }
        while ($row2 = $countries->fetch())
        {
          echo "<option value='" . $row2["name"] . "'>" . $row2["name"] . "</option>";
        }
      ?>
    </datalist>
  </main>

  <footer class="footer">
    <small>© BSZ AIR — made for a school project</small><br>
    <?php
      echo  date("H:i:s") . " — Have a great flight"; 
    ?>          <!-- https://www.w3schools.com/php/func_date_date.asp -->
  </footer>
</body>
</html>
