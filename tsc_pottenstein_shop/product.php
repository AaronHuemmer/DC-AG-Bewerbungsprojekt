<?php include 'header.php';
  $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  $p = fetch_product($pdo, $id);
  if (!$p) { echo "<p>Produkt nicht gefunden.</p>"; include 'footer.php'; exit; }
?>
  <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">
    <img src="assets/img/<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" style="width:100%; border-radius: 16px;">
    <div>
      <h1 style="margin-top:0;"><?php echo htmlspecialchars($p['name']); ?></h1>
      <p><?php echo nl2br(htmlspecialchars($p['description'])); ?></p>
      <p class="price" style="font-size:22px;"><?php echo format_price($p['price']); ?></p>
      <form class="add-to-cart-form" method="post" action="cart_action.php">
        <input type="hidden" name="product_id" value="<?php echo (int)$p['id']; ?>">
        <label>Menge: <input type="number" name="quantity" value="1" min="1" style="width:80px;"></label>
        <button class="btn primary" type="submit" style="margin-left:10px;">In den Warenkorb</button>
      </form>
    </div>
  </div>
<?php include 'footer.php'; ?>