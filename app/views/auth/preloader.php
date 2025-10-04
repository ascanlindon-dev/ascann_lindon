<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STUDENT LIST</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(135deg, #38ef7d 0%, #11998e 40%, #43cea2 70%, #60a5fa 100%);
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
      width: 70px;
      height: 70px;
      border-radius: 50%;
      border: 7px solid #fff;
      border-top: 7px solid #38ef7d;
      border-right: 7px solid #60a5fa;
      border-bottom: 7px solid #43cea2;
      border-left: 7px solid #e0f7fa;
      box-shadow: 0 0 32px 0 #38ef7d44, 0 0 16px 0 #60a5fa44;
      animation: spin 1s linear infinite;
      margin-bottom: 28px;
      background: linear-gradient(135deg, #e0f7fa 0%, #fff 100%);
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .title {
      font-size: 2.2rem;
      font-weight: bold;
      color: #fff;
      letter-spacing: 2px;
      text-shadow: 0 2px 12px #11998e99, 0 2px 8px #60a5fa99;
      background: linear-gradient(90deg, #38ef7d, #43cea2, #60a5fa, #e0f7fa);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-fill-color: transparent;
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
