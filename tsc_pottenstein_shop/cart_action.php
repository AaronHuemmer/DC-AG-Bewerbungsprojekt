<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

header('Content-Type: application/json; charset=utf-8');

$action = $_POST['action'] ?? '';
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;

if ($product_id > 0) {
    // Prüfe, ob Produkt existiert
    $stmt = $pdo->prepare("SELECT id, price FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $prod = $stmt->fetch();
    if (!$prod) {
        echo json_encode(['ok' => false, 'error' => 'unknown_product']); exit;
    }
}

switch ($action) {
    case 'add':
        $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + $quantity;
        break;
    case 'update':
        $_SESSION['cart'][$product_id] = $quantity;
        break;
    case 'remove':
        unset($_SESSION['cart'][$product_id]);
        break;
    default:
        echo json_encode(['ok' => false, 'error' => 'unknown_action']); exit;
}

$count = get_cart_count();
$total = get_cart_total($pdo);
$row_total = ($action === 'update') ? get_row_total($pdo, $product_id, $_SESSION['cart'][$product_id] ?? 0) : 0;

echo json_encode([
  'ok' => true,
  'count' => $count,
  'total' => $total,
  'total_formatted' => format_price($total),
  'row_total_formatted' => format_price($row_total)
]);