<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
        }
        .btn {
            width: 100%;
        }
        @media (min-width: 576px) {
            .btn {
                width: auto;
            }
        }
        .project-img {
            width: 100%;
            max-width: 400px;
            height: auto;
            display: block;
            margin: 10px auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .placeholder-img {
            width: 100%;
            max-width: 400px;
            height: 200px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 18px;
            border-radius: 8px;
            margin: 10px auto;
        }
    </style>
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
    die('<div class="container mt-5 text-danger">Project not found.</div>');
}

?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Project</h2>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow p-4">
            <form action="edit_project.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="pk" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title:</label>
                        <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="thumb" class="form-label">Project Thumbnail:</label>
                        <input type="file" class="form-control" name="thumb" accept="image/*">
                    </div>
                    <?php if (!empty($row['image'])) { ?>
                        <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" alt="Project Image" class="project-img">
                    <?php } else { ?>
                        <div class="placeholder-img">No Image</div>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Project Description:</label>
                        <textarea class="form-control" name="desc" rows="4" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="challenges" class="form-label">Challenges:</label>
                        <textarea class="form-control" name="challenges" rows="5" required><?php echo htmlspecialchars($row['challenges']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="solution" class="form-label">Solution:</label>
                        <textarea class="form-control" name="solution" rows="6" required><?php echo htmlspecialchars($row['solution']); ?></textarea>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type="submit" class="btn btn-primary">Update Project</button>
                        <a href="project_list.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>