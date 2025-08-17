<?php
function format_price($n) {
    return number_format((float)$n, 2, ',', '.') . ' €';
}

function get_cart_count() {
    return array_sum(array_values($_SESSION['cart'] ?? []));
}

function get_cart_total(PDO $pdo) {
    $total = 0.0;
    if (!empty($_SESSION['cart'])) {
        $ids = array_map('intval', array_keys($_SESSION['cart']));
        $in  = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("SELECT id, price FROM products WHERE id IN ($in)");
        $stmt->execute($ids);
        while ($row = $stmt->fetch()) {
            $qty = (int)($_SESSION['cart'][$row['id']] ?? 0);
            $total += ($row['price'] * $qty);
        }
    }
    return $total;
}

function get_row_total(PDO $pdo, $product_id, $qty) {
    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $price = (float)($stmt->fetchColumn() ?: 0);
    return $price * (int)$qty;
}

function fetch_categories(PDO $pdo) {
    $stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name");
    return $stmt->fetchAll();
}

function fetch_products(PDO $pdo, $category_id = null, $limit = null) {
    if ($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY id DESC";
        if ($limit) $sql .= " LIMIT " . (int)$limit;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_id]);
    } else {
        $sql = "SELECT * FROM products ORDER BY id DESC";
        if ($limit) $sql .= " LIMIT " . (int)$limit;
        $stmt = $pdo->query($sql);
    }
    return $stmt->fetchAll();
}

function fetch_product(PDO $pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}
?>