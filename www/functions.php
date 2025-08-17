<?php
require_once 'db.php';

function getProducts() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM products");
    return $stmt->fetchAll();
}

function saveOrder($name, $items) {
    global $pdo;
    $pdo->prepare("INSERT INTO orders (customer, items) VALUES (?, ?)")
        ->execute([$name, json_encode($items)]);
}
?>
