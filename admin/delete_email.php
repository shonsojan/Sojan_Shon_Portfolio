<?php
require_once('../includes/connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $connection->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([$_POST['id']]);
    echo "Contact deleted successfully!";
}
?>
