<?php include 'header.php'; ?>
  <h1>Alle Produkte</h1>

  <form method="get" style="margin: 0 0 16px 0">
    <label for="cat">Kategorie:</label>
    <select name="cat" id="cat" onchange="this.form.submit()">
      <option value="">Alle</option>
      <?php foreach (fetch_categories($pdo) as $c): ?>
        <option value="<?php echo (int)$c['id']; ?>" <?php if (!empty($_GET['cat']) && (int)$_GET['cat']===$c['id']) echo 'selected'; ?>><?php echo htmlspecialchars($c['name']); ?></option>
      <?php endforeach; ?>
    </select>
  </form>

  <div class="grid">
    <?php
      $cat = isset($_GET['cat']) ? (int)$_GET['cat'] : null;
      $products = fetch_products($pdo, $cat, null);
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