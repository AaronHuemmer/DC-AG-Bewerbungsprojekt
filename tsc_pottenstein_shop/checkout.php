<?php include 'header.php'; ?>
  <h1>Zur Kasse</h1>
  <?php
    if (empty($_SESSION['cart'])) {
      echo "<p>Dein Warenkorb ist leer.</p>";
      include 'footer.php'; exit;
    }
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $zip = trim($_POST['zip'] ?? '');

        if ($name === '') $errors[] = "Name ist erforderlich.";
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Gültige E-Mail ist erforderlich.";
        if ($address === '') $errors[] = "Adresse ist erforderlich.";
        if ($city === '') $errors[] = "Ort ist erforderlich.";
        if ($zip === '') $errors[] = "PLZ ist erforderlich.";

        if (!$errors) {
            // Bestellung speichern
            $pdo->beginTransaction();
            try {
                $stmt = $pdo->prepare("INSERT INTO orders (customer_name, email, address, city, zip, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                $stmt->execute([$name, $email, $address, $city, $zip]);
                $order_id = (int)$pdo->lastInsertId();

                $ids = array_map('intval', array_keys($_SESSION['cart']));
                $in  = implode(',', array_fill(0, count($ids), '?'));
                $stmtP = $pdo->prepare("SELECT id, price FROM products WHERE id IN ($in)");
                $stmtP->execute($ids);
                $prices = [];
                while ($row = $stmtP->fetch()) { $prices[$row['id']] = (float)$row['price']; }

                $stmtI = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                foreach ($_SESSION['cart'] as $pid => $qty) {
                    $pr = isset($prices[$pid]) ? $prices[$pid] : 0;
                    $stmtI->execute([$order_id, (int)$pid, (int)$qty, $pr]);
                }

                $pdo->commit();
                $_SESSION['cart'] = [];
                header("Location: thankyou.php?order_id=" . $order_id);
                exit;
            } catch (Exception $e) {
                $pdo->rollBack();
                $errors[] = "Fehler beim Speichern der Bestellung: " . $e->getMessage();
            }
        }
    }
  ?>

  <?php if ($errors): ?>
    <div class="form" style="border: 1px solid #f3d2d2; background:#fff6f6;">
      <strong>Bitte korrigieren:</strong>
      <ul>
        <?php foreach ($errors as $e): ?><li><?php echo htmlspecialchars($e); ?></li><?php endforeach; ?>
      </ul>
    </div>
    <br>
  <?php endif; ?>

  <form class="form" method="post">
    <div class="input">
      <label for="name">Name</label>
      <input id="name" name="name" required>
    </div>
    <div class="input">
      <label for="email">E-Mail</label>
      <input id="email" name="email" type="email" required>
    </div>
    <div class="input">
      <label for="address">Adresse</label>
      <input id="address" name="address" required>
    </div>
    <div class="input" style="display:grid; grid-template-columns: 1fr 160px; gap: 12px;">
      <div>
        <label for="city">Ort</label>
        <input id="city" name="city" required>
      </div>
      <div>
        <label for="zip">PLZ</label>
        <input id="zip" name="zip" required>
      </div>
    </div>
    <button class="btn primary" type="submit" style="width:fit-content;">Kostenpflichtig bestellen</button>
  </form>
<?php include 'footer.php'; ?>