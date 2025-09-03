<?php require __DIR__ . '/config.php'; ?>

<?php
$errors = [];
$okMsg  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = trim($_POST['name'] ?? '');
  $email    = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirm  = $_POST['confirm'] ?? '';

  if ($name === '' || $email === '' || $password === '' || $confirm === '') {
    $errors[] = 'All fields are required.';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format.';
  }
  if (strlen($password) < 6) {
    $errors[] = 'Password must be at least 6 characters.';
  }
  if ($password !== $confirm) {
    $errors[] = 'Passwords do not match.';
  }

  if (!$errors) {
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
      $errors[] = 'Email already registered.';
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $ins  = $pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
      $ins->execute([$name, $email, $hash]);

      // Redirect to login with a flag
      header("Location: login.php?registered=1");
      exit;
    }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body { font-family: system-ui, Arial; max-width: 420px; margin: 40px auto; padding: 0 16px; }
    form { display: grid; gap: 10px; padding: 16px; border: 1px solid #ddd; border-radius: 12px; }
    input { padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
    button { padding: 10px; border: 0; border-radius: 8px; cursor: pointer; }
    .primary { background: #222; color: #fff; }
    .errors { background: #ffe9e9; border: 1px solid #ffb3b3; padding: 10px; border-radius: 8px; }
    .tip { font-size: 14px; color: #555; }
    a { color: #0a58ca; text-decoration: none; }
  </style>
</head>
<body>
  <h2>Create your account</h2>

  <?php if ($errors): ?>
    <div class="errors">
      <?php foreach ($errors as $e) echo "<div>• " . htmlspecialchars($e) . "</div>"; ?>
    </div>
  <?php endif; ?>

  <form method="post" autocomplete="on">
    <input type="text" name="name" placeholder="Full name" value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>" required>
    <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>" required>
    <input type="password" name="password" placeholder="Password (min 6 chars)" required>
    <input type="password" name="confirm" placeholder="Confirm password" required>
    <button class="primary" type="submit">Sign up</button>
  </form>

  <p class="tip">Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
