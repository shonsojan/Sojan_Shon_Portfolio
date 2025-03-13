<?php
require_once('../includes/connect.php');

// Fetch user count
$userStmt = $connection->prepare('SELECT COUNT(*) as total_users FROM user');
$userStmt->execute();
$userCount = $userStmt->fetch(PDO::FETCH_ASSOC)['total_users'];

$contactStmt = $connection->prepare('SELECT COUNT(*) as total_contacts FROM tbl_users');
$contactStmt->execute();
$contactCount = $contactStmt->fetch(PDO::FETCH_ASSOC)['total_contacts'];

// Fetch project count
$projectStmt = $connection->prepare('SELECT COUNT(*) as total_projects FROM projects');
$projectStmt->execute();
$projectCount = $projectStmt->fetch(PDO::FETCH_ASSOC)['total_projects'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            transition: 0.3s;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
            transition: 0.3s;
        }
        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .dashboard-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1 1 300px;
        }
        .menu-toggle {
            display: none;
            background: #333;
            color: white;
            padding: 10px;
            cursor: pointer;
            text-align: center;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                display: none;
            }
            .content {
                margin-left: 0;
                width: 100%;
            }
            .menu-toggle {
                display: block;
            }
        }

        .chart-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .chart-box {
            width: 30%;
            min-width: 300px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 20px;
        }
        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="menu-toggle">☰ Menu</div>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a id="dashboard-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a id="users-link"><i class="fas fa-users"></i> Users</a>
        <a id="projects-link"><i class="fas fa-project-diagram"></i> Projects</a>
        <a id="contact-link"><i class="fas fa-address-book"></i> Contacts</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content" id="main-content">
        <h2>Dashboard</h2>
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h3>Registered Users</h3>
                <p><?php echo htmlspecialchars($userCount); ?></p>
            </div>
            <div class="dashboard-card">
                <h3>Total Contacts</h3>
                <p><?php echo htmlspecialchars($contactCount); ?></p>
            </div>
            <div class="dashboard-card">
                <h3>Total Projects</h3>
                <p><?php echo htmlspecialchars($projectCount); ?></p>
            </div>
        </div>
    </div>
    
    <h2>Dashboard Charts</h2>
    <div class="chart-container">
        <div class="chart-box">
            <h3>Bar Chart</h3>
            <canvas id="barChart"></canvas>
        </div>
        <div class="chart-box">
            <h3>Line Chart</h3>
            <canvas id="lineChart"></canvas>
        </div>
        <div class="chart-box">
            <h3>Pie Chart</h3>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <script>
        function loadCharts() {
            var labels = ['Users', 'Contacts', 'Projects'];
            var dataValues = [<?php echo json_encode($userCount); ?>, <?php echo json_encode($contactCount); ?>, <?php echo json_encode($projectCount); ?>];
            var colors = ['#007bff', '#FFA500', '#28a745'];

            // Bar Chart
            new Chart(document.getElementById('barChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{ label: 'Total Count', data: dataValues, backgroundColor: colors }]
                }
            });

            // Line Chart
            new Chart(document.getElementById('lineChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{ label: 'Growth Trend', data: dataValues, borderColor: '#FF5733' }]
                }
            });

            // Pie Chart
            new Chart(document.getElementById('pieChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{ data: dataValues, backgroundColor: colors }]
                }
            });
        }

        $(document).ready(function () {
            loadCharts();
            
            $(".menu-toggle").click(function () {
                $(".sidebar").slideToggle();
            });
            
            $("#dashboard-link").click(function () {
                location.reload();
            });
            
            $("#users-link").click(function () {
                $("#main-content").html("<h2>Loading Users...</h2>");
                $.get("users.php", function (data) {
                    $("#main-content").html(data);
                });
            });

            $("#contact-link").click(function () {
                $("#main-content").html("<h2>Loading Contacts...</h2>");
                $.get("emails.php", function (data) {
                    $("#main-content").html(data);
                });
            });
            
            $("#projects-link").click(function () {
                $("#main-content").html("<h2>Loading Projects...</h2>");
                $.get("projects.php", function (data) {
                    $("#main-content").html(data);
                });
            });
        });
        
    </script>
</body>
</html>
