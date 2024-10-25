<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    
    $sql = "UPDATE users SET name='$name', address='$address' WHERE id='$user_id'";
    $conn->query($sql);
}
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
</head>
<body>
    <h2>Profile</h2>
    <form method="post">
        Name: <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
        Address: <input type="text" name="address" value="<?php echo $user['address']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
