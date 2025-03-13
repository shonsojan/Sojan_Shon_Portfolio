<?php
require_once('../includes/connect.php');

// Fetch all users
$userStmt = $connection->prepare('SELECT id, first_name, last_name, email, message,created_at FROM contacts');
$userStmt->execute();
$users = $userStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #333; color: white; }
        .btn { padding: 5px 10px; border: none; cursor: pointer; margin: 2px; }
        .btn-add { background: green; color: white; }
        .btn-edit { background: blue; color: white; }
        .btn-delete { background: red; color: white; }
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
        .modal-content { background: white; padding: 20px; width: 40%; margin: 10% auto; }
        .close { float: right; cursor: pointer; }
        .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 20px;
    width: 40%;
    margin: auto;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-top: 10px;
}

input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

input:focus, select:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.btn-submit {
    background: #28a745;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 15px;
    font-size: 16px;
}

.btn-submit:hover {
    background: #218838;
}

    </style>
</head>
<body>

    <h2>Contact Management</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
<tr>
    <td><?php echo $user['id']; ?></td>
    <td><?php echo htmlspecialchars($user['first_name']); ?></td>
    <td><?php echo htmlspecialchars($user['last_name']); ?></td>
    <td><?php echo htmlspecialchars($user['email']); ?></td>
    <td><?php echo htmlspecialchars($user['message']); ?></td>
    <td><?php echo htmlspecialchars($user['created_at']); ?></td>
    <td>
        <button class="btn btn-delete" onclick="deleteEmail(<?php echo $user['id']; ?>)">Delete</button>
    </td>
</tr>
<?php endforeach; ?>

        </tbody>
    </table>

  <script>

function deleteEmail(userId) {
            if (confirm('Are you sure you want to delete Contact?')) {
                $.post('delete_email.php', { id: userId }, function(response) {
                    alert(response);
                    location.reload();
                });
            }
        }
  </script>


</body>

</html> 