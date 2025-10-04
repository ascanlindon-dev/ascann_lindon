<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STUDENT LIST</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(135deg, #2563eb, #60a5fa);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .loader {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .fb-loader {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      border: 6px solid #fff;
      border-top: 6px solid #2563eb;
      animation: spin 1s linear infinite;
      margin-bottom: 24px;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .title {
      font-size: 2rem;
      font-weight: bold;
      color: #fff;
      letter-spacing: 2px;
      text-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
  </style>
  <script>
    setTimeout(function() {
      window.location.href = "<?= site_url('login') ?>";
    }, 5000);
  </script>
</head>
<body>
  <div class="loader">
    <div class="fb-loader"></div>
    <div class="title">STUDENT LIST</div>
  </div>
</body>
</html>
