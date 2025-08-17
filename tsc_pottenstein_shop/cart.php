<?php include 'header.php'; ?>
  <h1>Warenkorb</h1>
  <?php
    $cart = $_SESSION['cart'] ?? [];
    if (empty($cart)) {
      echo "<p>Dein Warenkorb ist leer.</p>";
      include 'footer.php'; exit;
    }
    $ids = array_map('intval', array_keys($cart));
    $in  = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($in) ORDER BY name");
    $stmt->execute($ids);
    $items = $stmt->fetchAll();
  ?>
  <table class="table js-cart-table">
    <thead>
      <tr>
        <th>Produkt</th>
        <th>Preis</th>
        <th style="width:140px;">Menge</th>
        <th>Summe</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $it): 
        $pid = (int)$it['id'];
        $qty = (int)($cart[$pid] ?? 1);
        $row_total = $it['price'] * $qty;
      ?>
        <tr data-pid="<?php echo $pid; ?>">
          <td>
            <div style="display:flex; gap:12px; align-items:center;">
              <img src="assets/img/<?php echo htmlspecialchars($it['image']); ?>" alt="<?php echo htmlspecialchars($it['name']); ?>">
              <div>
                <div style="font-weight:700;"><?php echo htmlspecialchars($it['name']); ?></div>
                <div style="font-size:13px; color:#6c7c98;"><?php echo htmlspecialchars($it['description']); ?></div>
              </div>
            </div>
          </td>
          <td><?php echo format_price($it['price']); ?></td>
          <td>
            <input class="js-qty" type="number" min="1" value="<?php echo $qty; ?>" style="width:84px;">
          </td>
          <td class="js-row-total"><?php echo format_price($row_total); ?></td>
          <td><a href="#" class="js-remove">Entfernen</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3" style="text-align:right;">Gesamtsumme</td>
        <td class="js-cart-total"><?php echo format_price(get_cart_total($pdo)); ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>

  <div style="margin-top:16px; display:flex; gap:10px;">
    <a class="btn ghost" href="products.php">Weiter einkaufen</a>
    <a class="btn primary" href="checkout.php">Zur Kasse</a>
  </div>
<?php include 'footer.php'; ?>