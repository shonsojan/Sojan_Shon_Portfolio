<?php
require_once('../includes/connect.php'); // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure user ID is provided
    if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
        echo "User ID is required!";
        exit;
    }

    // Retrieve form data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    
    // Prepare the base SQL query (without password update)
    $sql = "UPDATE user SET username = ?, email = ?, full_name = ?, role = ?, status = ? WHERE id = ?";
    $params = [$username, $email, $full_name, $role, $status, $user_id];

    // Check if a new password is provided
    if (!empty($_POST['password'])) {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "UPDATE user SET username = ?, email = ?, full_name = ?, password = ?, role = ?, status = ? WHERE id = ?";
        $params = [$username, $email, $full_name, $hashedPassword, $role, $status, $user_id];
    }

    // Execute the update query
    $stmt = $connection->prepare($sql);
    if ($stmt->execute($params)) {
        echo "User updated successfully!";
    } else {
        echo "Failed to update user.";
    }
}
?>
