<?php require __DIR__ . '/config.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// A small DB check to prove the DB is live:
$totalUsers = (int)$pdo->query("SELECT COUNT(*) AS c FROM users")->fetch()['c'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body { font-family: system-ui, Arial; max-width: 700px; margin: 40px auto; padding: 0 16px; }
    .card { padding: 16px; border: 1px solid #ddd; border-radius: 12px; }
    a.button { display: inline-block; padding: 8px 12px; background: #222; color: #fff; border-radius: 8px; text-decoration: none; }
  </style>
</head>
<body>
  <h2>Hi, <?php echo htmlspecialchars($_SESSION['name']); ?> 👋</h2>

  <div class="card">
    <p>You are logged in as <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong>.</p>
    <p><strong>Users in database:</strong> <?php echo $totalUsers; ?></p>
    <p>This page proves sessions + DB queries are working.</p>
  </div>

  <p style="margin-top:16px;"><a class="button" href="logout.php">Logout</a></p>
</body>
</html>
