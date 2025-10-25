<?php
session_start();
require 'db.php';

if (isset($_POST['login_button']))
{
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $befehl = $pdo->prepare(
      "SELECT * FROM users 
      WHERE username = ? OR email = ? 
      AND password = ?"
      );
    $befehl->execute(array($identifier, $identifier, $password));

    $user = $befehl->fetch();

    if ($user)
      {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        header("Location: member.php");
        exit;
    }else
    {
        $error = "Wrong username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <main class="card">
    <h1 class="title">Welcome back</h1>
    <?php
      if (isset($error)) 
      {
        echo "<p style='color:red;'>$error</p>";
      }
    ?>
    <form class="form" method="post">
      <label class="label" for="identifier">Email or Username</label>
      <input class="input" id="identifier" name="identifier" type="text" required>

      <label class="label" for="password">Password</label>
      <input class="input" id="password" name="password" type="password" required>

      <button class="btn" type="submit" name="login_button">Log in</button>

      <div class="links">
        <a class="link" href="register.php">Create account</a>
        <a class="link" href="forgot_password.php">Forgot password?</a>
      </div>
    </form>
  </main>
</body>
</html>