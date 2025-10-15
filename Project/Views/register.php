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
      <label class="label" for="fullname">Full Name</label>
      <input class="input" id="fullname" name="fullname" type="text" required>

      <label class="label" for="email">Email Address</label>
      <input class="input" id="email" name="email" type="email" required>

      <label class="label" for="username">Username</label>
      <input class="input" id="username" name="username" type="text" required>

      <label class="label" for="phone">Phone Number</label>
      <input class="input" id="phone" name="phone" type="tel" required>

      <label class="label" for="password">Password</label>
      <input class="input" id="password" name="password" type="password" required>

      <label class="label" for="confirm">Confirm Password</label>
      <input class="input" id="confirm" name="confirm" type="password" required>

      <button class="btn" type="submit">Sign Up</button>

      <div class="links">
        <a class="link" href="login.php">Already have an account?</a>
      </div>
    </form>
  </main>
</body>
</html>
