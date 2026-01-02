<?php
session_start();

$id = $_POST['id'];
$action = $_POST['action'];

if ($action === 'increase') {
    $_SESSION['cart'][$id]++;
} elseif ($action === 'decrease') {
    $_SESSION['cart'][$id]--;
    if ($_SESSION['cart'][$id] <= 0) {
        unset($_SESSION['cart'][$id]);
    }
}

include 'db.php';

$total = 0;
$totalItems = 0;

foreach ($_SESSION['cart'] as $pid => $qty) {
    $result = mysqli_query($conn, "SELECT price FROM dishes WHERE id=$pid");
    $product = mysqli_fetch_assoc($result);

    $total += $product['price'] * $qty;
    $totalItems += $qty;

    if ($pid == $id) {
        $itemSubtotal = $product['price'] * $qty;
        $itemQty = $qty;
    }
}

header('Content-Type: application/json');

echo json_encode([
    'qty' => $itemQty,
    'subtotal' => $itemSubtotal,
    'total' => $total,
    'totalItems' => $totalItems
]);
