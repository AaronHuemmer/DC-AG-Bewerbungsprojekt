<?php
session_start();
$id = intval($_POST['id'] ?? 0);
if($id > 0){
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}
?>
