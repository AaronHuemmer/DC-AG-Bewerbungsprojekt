<?php include 'header.php'; ?>
  <h1>Vielen Dank!</h1>
  <p>Deine Bestellung wurde gespeichert.</p>
  <?php if (!empty($_GET['order_id'])): ?>
    <p>Bestellnummer: <strong>#<?php echo (int)$_GET['order_id']; ?></strong></p>
  <?php endif; ?>
  <p><a class="btn ghost" href="products.php">Zurück zum Shop</a></p>
<?php include 'footer.php'; ?>