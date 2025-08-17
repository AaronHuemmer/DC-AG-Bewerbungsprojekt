<?php require_once __DIR__ . '/config.php'; require_once __DIR__ . '/functions.php'; ?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TSC Pottenstein Fan-Shop</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="assets/js/app.js" defer></script>
</head>
<body>
  <header class="header">
    <div class="brand">
      <img src="assets/img/logo.png" alt="TSC Pottenstein Logo">
      <div class="title">TSC Pottenstein Fan‑Shop</div>
    </div>
    <nav class="nav">
      <a href="index.php">Start</a>
      <a href="products.php">Produkte</a>
      <a href="cart.php">Warenkorb <span class="cart-badge js-cart-count"><?php echo get_cart_count(); ?></span></a>
    </nav>
  </header>
  <div class="container">