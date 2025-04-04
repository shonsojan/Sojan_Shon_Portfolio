<!DOCTYPE html>
<html lang="en">
  <head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/grid.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <title>Shon Sojan</title>

    <script defer src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>


<script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
<script defer src="js/main.js"></script>


    <?php

require_once('includes/connect.php');



$stmt = $connection->prepare('SELECT projects.id AS project, image, image1, image2, image3, image4 FROM projects, media WHERE projects.id = project_id;');
$stmt->execute();

?>


  </head>
  <body>
    
    <header>
      <h1 class="hidden">Portfolio</h1>
      <h2 class="hidden">Shon Sojan</h2>
      <div class="logo">
      <a href="index.php"><img id="logo" src="images/logo.svg" alt="logo" /></a>
      </div>
      <nav>
        <ul class="nav-list">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="images/Sojan_Shon_Resume.pdf" class="resume" download>Resume</a></li>
        </ul>
      </nav>

      <button id="hamburger">&#9776;</button>
      <div id="menu" class="overlay">
        <button id="close">&times;</button>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="images/Sojan_Shon_Resume.pdf" class="resume" download>Resume</a></li>
          </ul>
        </nav>
</div>
    </header>

    <main>
    <div id="shonprogress"></div>
      <!-- PROFILE -->

      <section class="full-width-grid-con col-span-full black-bg">
        <div class="col-span-full profile">
          <h3 class="col-span-full">Namaste, I'm <span>Shon</span></h3>
          <p class="col-span-full">
            a Creative Front-End Developer with a passion for blending code and
            creativity. I craft interactive, visually engaging web experiences
            that are as functional as they are beautiful. With a focus on
            responsive design and user-friendly interfaces, I bring a unique
            touch to every project by merging the art of design with the power
            of development.
          </p>
        </div>
        <div class="col-span-full" id="tech">
          <p>Technologies I Master:</p>

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

      <!-- VIDEO -->

      <div class="grid-con">
        <section id="player-container" class="col-span-full">
          <video
            class="player"
            controls
            preload="metadata"
            poster="images/video.jpg"
          >
            <source src="video/Demo-reel.mp4" type="video/mp4" />
            <p>Ooops, something went wrong...</p>
          </video>
        </section>
      </div>


      <!-- WORKS -->

      <section class="full-width-grid-con col-span-full yellow-bg">
        <h2 class="col-span-full">SELECTED<br />PROJECTS</h2>
        <div class=".project col-span-full grid-con">

        
        <?php


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        

$cell = 0;

for($i = 0; $i < 1; $i++) {
    if($cell == 3) {
        $cell=1;
    }else{
        $cell++;
    }
    

    echo '<a href="details.php?id=' . $row['project'] . '">';

if($cell == 1) {
    echo '<div class="col-start-1 col-span-4">';
}else if($cell == 2){
    echo '<div class="col-start-5 col-span-4">';
}else{
    echo '<div class="col-start-9 col-span-4">';
}


echo '<img src="images/' . $row['image'] . '"></div>';
echo'</a>';
}

        }
        $stmt = null;


?>
        </div>
      </section>

      <!-- CONTACT -->

      <section id="contact" class="full-width-grid-con col-span-full white-bg">
        <h2 class="col-span-full">
          LET'S WORK<br />
          <span>TOGETHER</span>
        </h2>
        <div class="center col-span-full grid-con">
          <form class="col-span-full" id="contactForm" method="post" action="">

    <label for="first_name"><span class="required">*</span>First Name: </label>
    <input type="text" name="first_name" id="first_name">

<br><br>

    <label for="last_name"><span class="required">*</span>Last Name: </label>
    <input type="text" name="last_name" id="last_name">

    <br><br>

    <label for="email"><span class="required">*</span>Email: </label>
    <input type="text" name="email" id="email">

    <br><br>

    <label for="message"><span class="required">*</span>Message: </label>
    <textarea name="message" id="message" placeholder="comment here"></textarea>

    <br><br>

    <input type="submit" value="send">
    <br>
    <?php if (isset($_GET['message'])): ?>
    <div style="color: <?php echo $_GET['success'] == 'true' ? 'green' : 'red'; ?>;">
        <?php echo htmlspecialchars($_GET['message']); ?>
    </div>
<?php endif; ?>
    <section id="feedback"><p><span class="required">*</span>Please fill out all required sections</p></section>
</form>
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
    <script src="js/contact.js" defer></script>

  </body>
</html>
