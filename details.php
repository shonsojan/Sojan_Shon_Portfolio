<!DOCTYPE html>
<?php
require_once('includes/connect.php');
$query = 'SELECT * FROM projects, media WHERE project_id = projects.id AND projects.id = :projectid';
$stmt = $connection->prepare($query);
$projectid = $_GET['id'];
$stmt->bindParam(':projectid', $projectid, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = null;
?>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/grid.css" rel="stylesheet" type="text/css" />
    <title>Project</title>
    <script defer src="js/main.js"></script>

</head>
<body>
    <header class="sticky">
      <h1 class="hidden">Portfolio</h1>
      <h2 class="hidden">Shon Sojan</h2>
      <div class="logo">
        <img id="logo" src="images/logo.svg" alt="logo" />
      </div>
      <nav>
        <ul class="nav-list">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="index.php#contact">Contact</a></li>
        </ul>
      </nav>

      <button id="hamburger">&#9776;</button>
      <div id="menu" class="overlay">
        <button id="close">&times;</button>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="index.php#contact">Contact</a></li>
          </ul>
        </nav>
    </header>
    <main>
      <section class="black-bg3 full-width-grid-con col-span-full">
        <div class="col-span-full">
          <h3><?php echo $row['name']; ?></h3>
          <img src="./images/<?php echo $row['image1']; ?>" alt="project_image" />
        </div>
        <div class="col-span-full">
          <div class="grid-con details">
            <div
              class="col-span-full m-col-start-1 m-col-end-5 l-col-start-1 l-col-end-5"
            >
              <h4>Date</h4>
              <p>20/02/2024</p>
            </div>

            <div
              class="col-span-full m-col-start-5 m-col-end-9 l-col-start-5 l-col-end-9"
            >
              <h4>Role</h4>
              <p>Designer</p>
            </div>

            <div
              class="col-span-full m-col-start-9 l-col-end-13 m-col-start-9 l-col-end-13"
            >
              <h4>Team</h4>
              <p>Shon Sojan, Rebin Reji</p>
            </div>
          </div>
        </div>

        <div class="col-span-full" id="tech">
          <p>Technologies Used:</p>

          <ul id="tool">
            <li><img src="images/tool1.svg" /></li>
            <li><img src="images/tool2.svg" /></li>
            <li><img src="images/tool3.svg" /></li>
            <li><img src="images/tool4.svg" /></li>
            <li><img src="images/tool5.svg" /></li>
            <li><img src="images/tool6.svg" /></li>
          </ul>
        </div>
      </section>


      <section class="white-bg2 grid-con">
        <div class="col-span-full">
          <h3>Challenges</h3>
          <p>
          <?php echo $row['challeges']; ?>
          </p>
        </div>
        <div class="col-span-full">
          <h3>Solution</h3>
          <p>
          <?php echo $row['solution']; ?>
          </p>
        </div>
      </section>

      <section class="yellow-bg2 col-span-full">
        <div class="work grid-con">
          <div
            class="col-span-full m-col-start-1 m-col-end-5 l-col-start-1 l-col-end-5"
          >
            <img src="./images/<?php echo $row['image2']; ?>" />
          </div>
          <div
            class="col-span-full m-col-start-5 m-col-end-9 l-col-start-5 l-col-end-9"
          >
            <img src="./images/<?php echo $row['image3']; ?>" />
          </div>
          <div
            class="col-span-full m-col-start-9 m-col-end-13 l-col-start-9 l-col-end-13"
          >
            <img src="./images/<?php echo $row['image4']; ?>" />
          </div>
          <div class="col-span-full">
            <p>
            <?php echo $row['description']; ?>
            </p>
          </div>
        </div>
      </section>
    </main>
    <!-- Footer -->
    <footer>
      <p>&copy;2024 All rights reserved</p>
      <div id="media">
        <a href="https://www.linkedin.com/in/shon-sojan-87b83928a/"
          ><img src="images/media1.svg" alt="socialmedia-icon"
        /></a>
        <a href="https://github.com/shonsojan"
          ><img src="images/media2.svg" alt="socialmedia-icon" />
        </a>
      </div>
    </footer>
    
  </body>
</html>