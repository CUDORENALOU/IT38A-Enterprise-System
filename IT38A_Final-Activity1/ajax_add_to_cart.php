<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$product = [
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'image' => $_POST['image'],
    'quantity' => 1
];

// Check if product already in cart, increment quantity if so
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['name'] === $product['name']) {
        $item['quantity'] += 1;
        $found = true;
        break;
    }
}
unset($item);

if (!$found) {
    $_SESSION['cart'][] = $product;
}

// Calculate new cart count
$cart_count = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_count += $item['quantity'];
}

header('Content-Type: application/json');
echo json_encode(['cart_count' => $cart_count]);
exit(); 