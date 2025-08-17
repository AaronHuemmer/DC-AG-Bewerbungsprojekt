<?php
session_start();
require_once 'functions.php';
$products = getProducts();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>TSC Pottenstein Fanshop</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <h1><img src="assets/logo.png" alt="Logo" style="height:50px;"> TSC Pottenstein Fanshop</h1>
    <a href="cart.php">🛒 Warenkorb</a>
    <div class="products">
        <?php foreach($products as $p): ?>
            <div class="product">
                <h3><?= htmlspecialchars($p['name']) ?></h3>
                <p><?= htmlspecialchars($p['price']) ?> €</p>
                <button class="add-to-cart" data-id="<?= $p['id'] ?>">In den Warenkorb</button>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
