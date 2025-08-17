<?php
// Basis-Konfiguration für XAMPP (localhost). Passe sie bei Bedarf an.
$DB_HOST = 'localhost';
$DB_NAME = 'tsc_shop';
$DB_USER = 'root';
$DB_PASS = ''; // XAMPP-Standard: leer

$CURRENCY_SYMBOL = '€';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("DB-Verbindung fehlgeschlagen: " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// initialisiere Warenkorb
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>