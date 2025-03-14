<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>

    <link rel="stylesheet" href="../css/main.css" type="text/css">
    
    
</head>

<body>
<?php
require_once('../includes/connect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$projectId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = 'SELECT * FROM projects WHERE id = :projectId';
$stmt = $connection->prepare($query);
$stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die('<div>Project not found.</div>');
}

?>

<div>
    <h2>Edit Project</h2>
    <div>
        <div>
            <div>
            <form action="edit_project.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="pk" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <div>
                        <label for="title" class="form-label">Project Title:</label>
                        <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                    </div>
                    <div>
                        <label for="thumb" class="form-label">Project Thumbnail:</label>
                        <input type="file" class="form-control" name="thumb" accept="image/*">
                    </div>
                    <?php if (!empty($row['image'])) { ?>
                        <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" alt="Project Image" class="project-img">
                    <?php } else { ?>
                        <div>No Image</div>
                    <?php } ?>
                    <div>
                        <label for="desc" class="form-label">Project Description:</label>
                        <textarea class="form-control" name="desc" rows="4" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                    </div>
                    <div>
                        <label for="challenges" class="form-label">Challenges:</label>
                        <textarea class="form-control" name="challenges" rows="5" required><?php echo htmlspecialchars($row['challenges']); ?></textarea>
                    </div>
                    <div>
                        <label for="solution" class="form-label">Solution:</label>
                        <textarea class="form-control" name="solution" rows="6" required><?php echo htmlspecialchars($row['solution']); ?></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Update Project</button>
                        <a href="project_list.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>