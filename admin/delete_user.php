<?php
require_once('../includes/connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $connection->prepare("DELETE FROM user WHERE id = ?");
    $stmt->execute([$_POST['id']]);
    echo "User deleted successfully!";
}
?>
