<?php
require_once('../includes/connect.php');

$stmt = $connection->prepare('SELECT id, name, description, image, created_at, updated_at FROM projects ORDER BY name ASC');
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Main Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
                * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            border-bottom: 1px solid #555;
            padding-bottom: 10px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            margin: 5px 0;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .main-content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
            transition: margin-left 0.3s;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .add-project-btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s;
        }

        .add-project-btn:hover {
            background-color: #0056b3;
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .project-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: center;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.15);
        }

        .project-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .placeholder-img {
            width: 100%;
            height: 150px;
            background: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .project-name {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .project-description {
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            word-wrap: break-word;
        }

        .project-dates {
            font-size: 12px;
            color: #777;
            margin-bottom: 10px;
        }

        .project-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .project-actions a {
            text-decoration: none;
            padding: 5px 10px;
            color: white;
            border-radius: 4px;
            font-size: 14px;
            transition: 0.3s;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .logout-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

        /* RESPONSIVENESS */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .top-bar {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .project-grid {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
            }
        }


    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="dashboard.php"><i class="fas fa-users"></i> Users</a>
        <a href="dashboard.php"><i class="fas fa-project-diagram"></i> Projects</a>
        <a href="dashboard.php"><i class="fas fa-address-book"></i> Contacts</a>

        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h2>Project management</h2>
            <a href="add_project.php" class="add-project-btn">+ Add Project</a>
        </div>

        <div class="project-grid">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="project-card">
                <?php if (!empty($row['image'])) { ?>
                        <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" alt="Project Image" class="project-img">
                    <?php } else { ?>
                        <div class="placeholder-img">No Image</div>
                    <?php } ?>
                    <div class="project-name"><?php echo htmlspecialchars($row['name']); ?></div>
                    <div class="project-description">
    <?php echo nl2br(htmlspecialchars($row['description'])); ?>
</div>
                    <div class="project-dates">
                        <small>Created: <?php echo htmlspecialchars($row['created_at']); ?></small> <br>
                        <small>Updated: <?php echo htmlspecialchars($row['updated_at']); ?></small>
                    </div>
                    <div class="project-actions">
                        <a href="edit_project_form.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                        <a href="delete_project.php?id=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>