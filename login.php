<?php require __DIR__ . '/config.php'; ?>

<?php
$errors = [];
$notice = '';

if (isset($_GET['registered'])) {
  $notice = 'Registration successful. You can log in now.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email    = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  if ($email === '' || $password === '') {
    $errors[] = 'Email and password are required.';
  } else {
    $stmt = $pdo->prepare("SELECT id, name, email, password_hash FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
      $errors[] = 'Invalid email or password.';
    } else {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['name']    = $user['name'];
      $_SESSION['email']   = $user['email'];
      header("Location: dashboard.php");
      exit;
    }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body { font-family: system-ui, Arial; max-width: 420px; margin: 40px auto; padding: 0 16px; }
    form { display: grid; gap: 10px; padding: 16px; border: 1px solid #ddd; border-radius: 12px; }
    input { padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
    button { padding: 10px; border: 0; border-radius: 8px; cursor: pointer; }
    .primary { background: #222; color: #fff; }
    .errors { background: #ffe9e9; border: 1px solid #ffb3b3; padding: 10px; border-radius: 8px; }
    .notice { background: #e9f7ff; border: 1px solid #b3e1ff; padding: 10px; border-radius: 8px; }
    a { color: #0a58ca; text-decoration: none; }
  </style>
</head>
<body>
  <h2>Welcome back</h2>

  <?php if ($notice): ?>
    <div class="notice"><?php echo htmlspecialchars($notice); ?></div>
  <?php endif; ?>

  <?php if ($errors): ?>
    <div class="errors">
      <?php foreach ($errors as $e) echo "<div>• " . htmlspecialchars($e) . "</div>"; ?>
    </div>
  <?php endif; ?>

  <form method="post" autocomplete="on">
    <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>" required>
    <input type="password" name="password" placeholder="Password" required>
    <button class="primary" type="submit">Login</button>
  </form>

  <p>New here? <a href="register.php">Create an account</a></p>
</body>
</html>
