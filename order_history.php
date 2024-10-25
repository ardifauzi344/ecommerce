<?php
include 'db.php';
include 'session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Order History</h1>
    <ul>
        <?php while ($order = $result->fetch_assoc()): ?>
            <li>Order ID: <?php echo $order['id']; ?> - Total Price: $<?php echo $order['total_price']; ?> - Date: <?php echo $order['created_at']; ?></li>
        <?php endwhile; ?>
    </ul>
    <a href="index.php">Back to Home</a>
</body>
</html>
