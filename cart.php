<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['cart'][$id] = isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id] + 1 : 1;
}

// Remove product from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
}

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
</head>
<body>
    <h2>Shopping Cart</h2>
    <ul>
        <?php foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $sql = "SELECT * FROM products WHERE id = $product_id";
            $product = $conn->query($sql)->fetch_assoc();
            $price = $product['price'] * $quantity;
            $total_price += $price;
            echo "<li>{$product['name']} - $quantity <a href='cart.php?remove=$product_id'>Remove</a></li>";
        } ?>
    </ul>
    <p>Total Price: $<?php echo $total_price; ?></p>
    <a href="checkout.php">Checkout</a>
    <a href="products.php">Continue Shopping</a>
</body>
</html>
