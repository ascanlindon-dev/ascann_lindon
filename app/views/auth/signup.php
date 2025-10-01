<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="w-full max-w-md bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Sign Up</h2>
    <?php if (!empty($error ?? null)): ?>
      <div class="bg-red-100 text-red-700 p-2 rounded mb-3"><?php echo html_escape($error); ?></div>
    <?php endif; ?>
    <form action="<?= site_url('signup') ?>" method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium">First Name</label>
        <input type="text" name="firstname" required class="w-full border p-2 rounded">
      </div>
      <div>
        <label class="block text-sm font-medium">Last Name</label>
        <input type="text" name="lastname" required class="w-full border p-2 rounded">
      </div>
      <div>
        <label class="block text-sm font-medium">Username</label>
        <input type="text" name="username" required class="w-full border p-2 rounded">
      </div>
      <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" required class="w-full border p-2 rounded">
      </div>
      <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" required class="w-full border p-2 rounded">
      </div>
      <div>
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Sign Up</button>
      </div>
    </form>
    <div class="mt-4 text-center">
      <a href="<?= site_url('login') ?>" class="text-blue-600">Already have an account? Log in</a>
    </div>
  </div>
</body>
</html>
