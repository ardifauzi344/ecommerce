<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
$product = $conn->query($sql)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $product['name']; ?></title>
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <img src="assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p>Price: $<?php echo $product['price']; ?></p>
    <p><?php echo $product['description']; ?></p>
    <a href="cart.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
    <a href="products.php">Back to Products</a>
</body>
</html>
