<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Warenkorb</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>🛒 Warenkorb</h1>
    <a href="index.php">⬅ Zurück zum Shop</a>
    <?php if(empty($cart)): ?>
        <p>Dein Warenkorb ist leer.</p>
    <?php else: ?>
        <ul>
        <?php foreach($cart as $id => $qty): ?>
            <li>Produkt #<?= $id ?> - Menge: <?= $qty ?></li>
        <?php endforeach; ?>
        </ul>
        <form method="post" action="order.php">
            <input type="text" name="name" placeholder="Dein Name" required>
            <button type="submit">Bestellung absenden</button>
        </form>
    <?php endif; ?>
</body>
</html>
