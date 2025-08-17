<?php
session_start();
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? 'Unbekannt';
    $items = $_SESSION['cart'] ?? [];
    saveOrder($name, $items);
    $_SESSION['cart'] = [];
    $msg = "Danke $name, deine Bestellung wurde gespeichert!";
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellung</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?= $msg ?? "Fehler bei der Bestellung" ?></h1>
    <a href="index.php">⬅ Zurück zum Shop</a>
</body>
</html>
