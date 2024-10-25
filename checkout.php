<?php
include 'db.php';
include 'session.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $total_price = 0;

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT price FROM products WHERE id='$product_id'";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();
        $total_price += $product['price'] * $quantity;
    }

    // Insert order
    $sql = "INSERT INTO orders (user_id, total_price, created_at) VALUES ('$user_id', '$total_price', NOW())";
    $conn->query($sql);
    $order_id = $conn->insert_id;

    // Insert order items
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
        $conn->query($sql);
    }

    // Clear the cart
    unset($_SESSION['cart']);
    header("Location: order_history.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Checkout</h1>
    <form method="POST">
        <h2>Total Price: $<?php
            $total_price = 0;
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $sql = "SELECT price FROM products WHERE id='$product_id'";
                $result = $conn->query($sql);
                $product = $result->fetch_assoc();
                $total_price += $product['price'] * $quantity;
            }
            echo $total_price;
        ?></h2>
        <button type="submit">Place Order</button>
    </form>
    <a href="cart.php">Back to Cart</a>
</body>
</html>
