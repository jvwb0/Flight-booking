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
      <a class="nav-link" href="login.php">Login</a>
      <a class="nav-link strong" href="register.php">Sign Up</a>
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
$pick = $images[array_rand($images)];
?>
<section class="banner">
  <img src="<?= $pick ?>" alt="Banner" class="banner-img">
</section>

  <!-- Flight Search -->
  <main class="card search-card">
    <h2 class="title" style="margin-bottom:12px;">Search Flights</h2>

    <form class="form search-form" method="get">
      <div class="row">
        <div class="field">
          <label class="label" for="from">From</label>
          <input class="input" id="from" name="from" type="text" placeholder="e.g., Berlin (BER)" required>
        </div>

        <div class="field">
          <label class="label" for="to">To</label>
          <input class="input" id="to" name="to" type="text" placeholder="e.g., Lisbon (LIS)" required>
        </div>
      </div>

      <div class="row">
        <div class="field">
          <label class="label" for="depart">Depart</label>
          <input class="input" id="depart" name="depart" type="date" required>
        </div>

        <div class="field">
          <label class="label" for="return">Return (optional)</label>
          <input class="input" id="return" name="return" type="date">
        </div>
      </div>

      <div class="row">
        <div class="field">
          <label class="label" for="passengers">Passengers</label>
          <select class="input" id="passengers" name="passengers">
            <option>1</option><option>2</option><option>3</option>
            <option>4</option><option>5</option><option>6</option>
          </select>
        </div>

        <div class="field">
          <label class="label" for="class">Class</label>
          <select class="input" id="class" name="class">
            <option value="economy">Economy</option>
            <option value="premium">Premium Economy</option>
            <option value="business">Business</option>
          </select>
        </div>
      </div>

      <button class="btn" type="submit">Search Flights</button>
    </form>
  </main>

  <footer class="footer">
    <small>© Sunset Air — made for a school project</small>
  </footer>
</body>
</html>
