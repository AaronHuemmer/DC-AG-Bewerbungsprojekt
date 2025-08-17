<?php include 'header.php'; ?>
  <section class="hero">
    <div class="hero-text">
      <h1>Willkommen im offiziellen TSC Pottenstein Fan‑Shop</h1>
      <p>Frische Trikots, kuschelige Schals, classy Caps und mehr. Unterstütze deinen Verein – im Stadion und im Alltag.</p>
      <a class="cta" href="products.php">Jetzt shoppen</a>
    </div>
    <img src="assets/img/heimtrikot.png" alt="TSC Heimtrikot">
  </section>

  <h2 style="margin:22px 0 12px 0;">Neu im Shop</h2>
  <div class="grid">
    <?php
      $products = fetch_products($pdo, null, 4);
      foreach ($products as $p):
    ?>
      <div class="card">
        <img src="assets/img/<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
        <div class="pad">
          <h3><?php echo htmlspecialchars($p['name']); ?></h3>
          <p class="desc"><?php echo htmlspecialchars($p['description']); ?></p>
          <div class="price"><?php echo format_price($p['price']); ?></div>
          <div class="actions">
            <a class="btn ghost" href="product.php?id=<?php echo (int)$p['id']; ?>">Details</a>
            <form class="add-to-cart-form" method="post" action="cart_action.php" style="display:inline;">
              <input type="hidden" name="product_id" value="<?php echo (int)$p['id']; ?>">
              <input type="hidden" name="quantity" value="1">
              <button class="btn primary" type="submit">In den Warenkorb</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php include 'footer.php'; ?>