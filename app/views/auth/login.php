<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center" style="background: linear-gradient(135deg, #38ef7d 0%, #11998e 40%, #43cea2 70%, #60a5fa 100%);">
  <div class="w-full max-w-md bg-white/90 p-8 rounded-2xl shadow-2xl border border-blue-200">
  <h2 class="text-2xl font-bold mb-4" style="background: linear-gradient(90deg, #38ef7d, #43cea2, #60a5fa, #e0f7fa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-fill-color: transparent;">Please sign in</h2>
    <?php if (!empty(
      $error ?? null)): ?>
      <div class="bg-red-100 text-red-700 p-2 rounded mb-3"><?php echo html_escape($error); ?></div>
    <?php endif; ?>
    <form action="<?= site_url('login') ?>" method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Username</label>
        <input type="text" name="username" required class="w-full border p-2 rounded">
      </div>
      <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" required class="w-full border p-2 rounded">
      </div>
      <div>
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Sign in</button>
      </div>
    </form>
    <div class="mt-4 text-center">
      <a href="<?= site_url('signup') ?>" class="text-blue-600">Don't have an account? Sign up</a>
    </div>
  </div>
</body>
</html>
