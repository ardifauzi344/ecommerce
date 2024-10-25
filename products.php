<?php
include 'db.php';

$limit = 10; // products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
$total_products = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$total_pages = ceil($total_products / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
</head>
<body>
    <h2>Products</h2>
    <div>
        <?php while ($product = $result->fetch_assoc()) { ?>
            <div>
                <img src="assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p>$<?php echo $product['price']; ?></p>
                <a href="product_detail.php?id=<?php echo $product['id']; ?>">View</a>
            </div>
        <?php } ?>
    </div>
    <div>
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php } ?>
    </div>
</body>
</html>
