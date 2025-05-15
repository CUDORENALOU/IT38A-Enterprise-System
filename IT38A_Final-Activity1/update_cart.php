<?php
session_start();
if (isset($_POST['index'], $_POST['action']) && isset($_SESSION['cart'][$_POST['index']])) {
    $index = $_POST['index'];
    if ($_POST['action'] === 'increase') {
        $_SESSION['cart'][$index]['quantity'] += 1;
    } elseif ($_POST['action'] === 'decrease') {
        $_SESSION['cart'][$index]['quantity'] -= 1;
        if ($_SESSION['cart'][$index]['quantity'] < 1) {
            array_splice($_SESSION['cart'], $index, 1); // Remove product if quantity < 1
        }
    }
}
header('Location: cart.php');
exit(); 