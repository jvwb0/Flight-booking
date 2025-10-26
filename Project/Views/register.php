<?php
require '../assets/db.php';

if (isset($_POST['signup_button'])) {
  $first_name = $_POST['first_name'];
  $last_name  = $_POST['last_name'];
  $email      = $_POST['email'];
  $username   = $_POST['username'];
  $password   = $_POST['password'];

  $befehl = $pdo->prepare("INSERT INTO users (first_name, last_name, email, username, password)
                          VALUES (?, ?, ?, ?, ?)");
  $befehl->execute(array($first_name, $last_name, $email, $username, $password));

# pop up / dialog fenster ding
  echo "<script>
    alert('Account created. Please log in.');
    window.location = 'login.php';
    </script>";
  exit;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Account</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <main class="card">
    <h1 class="title">Create Account</h1>

    <form class="form" method="post">
      <label class="label" for="first name">First Name</label>
      <input class="input" id="first name" name="first name" type="text" required>

      <label class="label" for="last name">Last Name</label>
      <input class="input" id="last name" name="last name" type="text" required>

      <label class="label" for="email">Email Address</label>
      <input class="input" id="email" name="email" type="email" required>

      <label class="label" for="username">Username</label>
      <input class="input" id="username" name="username" type="text" required>

      <label class="label" for="password">Password</label>
      <input class="input" id="password" name="password" type="password" required>

      <label class="label" for="confirm">Confirm Password</label>
      <input class="input" id="confirm" name="confirm" type="password" required>

      <button class="btn" type="submit" name ="signup_button">Sign Up</button>

      <div class="links">
        <a class="link" href="login.php">Already have an account?</a>
      </div>
    </form>
    <button class="btn" style="width: 49%;" type="button" onclick="window.location.href='<?php echo $_SERVER['HTTP_REFERER'] ?? 'main.php'; ?>'">Back</button>
    <button class="btn" style="width: 49%;" type="button" onclick="window.location.href='main.php'">Home</button>
  </main>
</body>
</html>
