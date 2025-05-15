<?php
session_start();
if (isset($_POST['index'], $_POST['action']) && isset($_SESSION['cart'][$_POST['index']])) {
    $index = $_POST['index'];
    if ($_POST['action'] === 'increase') {
        $_SESSION['cart'][$index]['quantity'] += 1;
    } elseif ($_POST['action'] === 'decrease') {
        $_SESSION['cart'][$index]['quantity'] -= 1;
        if ($_SESSION['cart'][$index]['quantity'] < 1) {
            array_splice($_SESSION['cart'], $index, 1);
            echo json_encode(['quantity' => 0, 'subtotal' => number_format(array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $_SESSION['cart'])), 2)]);
            exit;
        }
    }
    $quantity = $_SESSION['cart'][$index]['quantity'];
    $subtotal = number_format(array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $_SESSION['cart'])), 2);
    echo json_encode(['quantity' => $quantity, 'subtotal' => $subtotal]);
    exit;
}
echo json_encode(['quantity' => 0, 'subtotal' => '0.00']);
exit; 