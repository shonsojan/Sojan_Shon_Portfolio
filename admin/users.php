<?php
require_once('../includes/connect.php');

// Fetch all users
$userStmt = $connection->prepare('SELECT id, username, email, full_name, role, status, created_at, updated_at FROM user');
$userStmt->execute();
$users = $userStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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

    <h2>User Management</h2>
    <button class="btn btn-add" onclick="addUser()">Add User</button>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['full_name'] ?? 'N/A'); ?></td>
                <td><?php echo ucfirst($user['role']); ?></td>
                <td><?php echo ucfirst($user['status']); ?></td>
                <td>
                    <button class="btn btn-edit" onclick="editUser(<?php echo $user['id']; ?>, '<?php echo $user['username']; ?>', '<?php echo $user['email']; ?>', '<?php echo $user['full_name']; ?>', '<?php echo $user['role']; ?>', '<?php echo $user['status']; ?>')">Edit</button>
                    <button class="btn btn-delete" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="userModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="addUser()">&times;</span>
        <h3 id="modalTitle">Add User</h3>
        <form id="userForm">
            <input type="hidden" name="user_id" id="user_id"> <!-- Hidden field for user ID -->

            <label>Username:</label>
            <input type="text" name="username" id="username" required>

            <label>Email:</label>
            <input type="email" name="email" id="email" required>

            <label>Full Name:</label>
            <input type="text" name="full_name" id="full_name" required>

            <label>Password:</label>
            <input type="password" name="password" id="password" required>

            <label>Role:</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="manager">Manager</option>
            </select>

            <label>Status:</label>
            <select name="status" id="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <button type="submit" class="btn-submit" id="submitButton">Add</button>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'block';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    function addUser() {
        // Reset form for adding a new user
        document.getElementById("modalTitle").textContent = "Add User";
        document.getElementById("submitButton").textContent = "Add";
        document.getElementById("userForm").reset();
        document.getElementById("user_id").value = ""; // Clear user ID for new user
        openModal('userModal');
    }

    function editUser(id, username, email, full_name, role, status) {
        // Set form fields with existing user data
        document.getElementById("modalTitle").textContent = "Update User";
        document.getElementById("submitButton").textContent = "Update";
        document.getElementById("user_id").value = id;
        document.getElementById("username").value = username;
        document.getElementById("email").value = email;
        document.getElementById("full_name").value = full_name;
        document.getElementById("role").value = role;
        document.getElementById("status").value = status;
        openModal('userModal');
    }

    $(document).ready(function() {
        $('#userForm').submit(function(e) {
            e.preventDefault();
            const isEdit = $('#user_id').val() !== "";

            $.post(isEdit ? 'update_user.php' : 'add_user.php', $(this).serialize(), function(response) {
                alert(response);
                location.reload();
            });
        });
    });

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.post('delete_user.php', { id: userId }, function(response) {
                    alert(response);
                    location.reload();
                });
            }
        }
    </script>
</body>

</html> 