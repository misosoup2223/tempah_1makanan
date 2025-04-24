<?php
session_start();
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Promotion</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      padding: 0;
      background-color: #FFDFEF;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .welcome-message {
      margin-top: 40px;
      text-align: center;
      color: #AA60C8;
      font-size: 26px;
      font-weight: bold;
    }

    .promo-wrapper {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
      margin: 30px auto;
      padding: 20px;
      max-width: 1200px;
    }

    .promo-card {
      width: 250px;
      height: 350px;
      margin: 20px;
      background-color: #EABDE6;
      border-radius: 15px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      background-size: cover;
      background-position: center;
    }

    .promo-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));
      z-index: 0;
      pointer-events: none;
    }

    .promo-content {
      position: relative;
      z-index: 1;
      padding: 20px;
      padding-bottom: 30px;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      box-sizing: border-box;
    }

    .promo-content h3 {
      margin: 0;
      font-size: 20px;
      font-weight: bold;
    }

    .promo-content p {
      margin: 10px 0;
      font-size: 14px;
    }

    .promo-content button {
      background-color: #EABDE6;
      color: #000;
      padding: 10px 20px;
      border: none;
      border-radius: 25px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .promo-content button:hover {
      background-color: #D69ADE;
    }

    header, footer {
      width: 100%;
    }

    footer {
      text-align: center;
      padding: 10px 0;
    }
  </style>
</head>
<body>
  <div class="welcome-message">
    Welcome to Lost in the Cup Cafe!<br>
    Check out our latest promotions below.
  </div>

  <div class="promo-wrapper">
    <div class="promo-card" style="background-image: url('gambar/promo.png');">
      <div class="promo-content">
        <a href="signup.php">
          <button>Shop Now</button>
        </a>
      </div>
    </div>

    <div class="promo-card" style="background-image: url('gambar/promo2.png');">
      <div class="promo-content">
        <a href="signup.php">
          <button>Grab It</button>
        </a>
      </div>
    </div>

    <div class="promo-card" style="background-image: url('gambar/promo3.png');">
      <div class="promo-content">
        <a href="signup.php">
          <button>Join Now</button>
        </a>
      </div>
    </div>
  </div>

<?php include('footer.php'); ?>
</body>
</html>


