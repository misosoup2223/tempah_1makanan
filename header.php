<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (isset($_SESSION['orders']) && count($_SESSION['orders']) > 0) {
  $bil = "<span class='cart-count'>" . count($_SESSION['orders']) . "</span>";
} else {
  $bil = "";
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lost In The Cup Cafe</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #FFDFEF;
      color: #AA60C8;
      line-height: 1.6;
    }

    header {
      background-color: #EABDE6;
      box-shadow: 0 4px 8px rgba(170, 96, 200, 0.1);
    }

    .header-container {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 15px 20px;
    }

    .logo, .icon {
      height: 45px;
      width: 45px;
      border-radius: 50%;
      object-fit: cover;
      background-color: #fff;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
    }

    .site-title {
      font-size: 1.8em;
      font-weight: bold;
      color: #AA60C8;
      margin: 0;
    }

    nav.main-nav {
      background-color: #D69ADE;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      padding: 12px;
    }

    nav.main-nav a {
      position: relative;
      text-decoration: none;
      color: white;
      background-color: #AA60C8;
      margin: 6px 10px;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: bold;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    nav.main-nav a:hover {
      background-color: #8C48A8;
      transform: scale(1.05);
    }

    nav .separator {
      color: white;
      font-weight: bold;
      align-self: center;
      margin: 0 6px;
    }

    .cart-count {
      position: absolute;
      top: -8px;
      right: -8px;
      background-color: white;
      color: #AA60C8;
      border-radius: 50%;
      font-size: 0.75em;
      font-weight: bold;
      padding: 5px 8px;
      min-width: 22px;
      text-align: center;
      line-height: 1;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 600px) {
      .site-title {
        font-size: 1.4em;
      }

      nav.main-nav {
        flex-direction: column;
        align-items: center;
      }

      nav .separator {
        display: none;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="header-container">
    <img src="gambar/logo.png" alt="Logo" class="logo">
    <h1 class="site-title">Lost In The Cup Cafe</h1>
    <img src="gambar/logo.png" alt="Icon" class="icon">
  </div>

  <nav class="main-nav">
    <?php if (!empty($_SESSION['tahap'])): ?>
      <a href='menu.php'>Menu</a>
      <span class="separator">|</span>
      <a href='tempah-cart.php'>Cart<?= $bil ?></a>
      <span class="separator">|</span>
      <a href='tempah-sejarah.php'>Order History</a>
      <?php if ($_SESSION['tahap'] == "ADMIN"): ?>
        <span class="separator">|</span>
        <a href='pengguna-senarai.php'>User List</a>
        <span class="separator">|</span>
        <a href='menu-senarai.php'>Menu List</a>
        <span class="separator">|</span>
        <a href='laporan.php'>Order Report</a>
      <?php endif; ?>
      <span class="separator">|</span>
      <a href='logout.php'>Logout</a>
    <?php else: ?>
      <a href='index.php'>Home</a>
      <span class="separator">|</span>
      <a href='login.php'>Login</a>
      <span class="separator">|</span>
      <a href='signup.php'>Signup</a>
    <?php endif; ?>
  </nav>
</header>





