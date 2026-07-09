<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Success Directory</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- -- Header ------------------------------- -->

<?php
include "../Header_Footer/Header.php";
?>

<!-- --------------------------------------------------------------------------------------------------------------------- -->   

<!-- -- Home ------------------------------- -->
 
<main class="home-container">

    <div class="auth-bar">
      <a href="../Admin Page/admin_page.php" class="admin-link">Admin Login</a>
    </div>

    <div class="hero-content">
      <div class="div-logo"><img src="Images/Logo.png" alt="Alumni Success Directory logo"></div>
      <div class="hero-badge">CONNECTING GENERATIONS OF SUCCESS</div>
      
      <h1 class="hero-title">
        Alumni Success
        <em>Directory</em>
      </h1>
      
      <p class="hero-subtitle">
        Real advice from real seniors. Discover where your predecessors are thriving and the wisdom they carry with them.
      </p>
      
      <div class="hero-cta">
        <a href="../Login Page/login.php"><button class="btn-outline">Share Your Story</button></a>
        <a href="../Directory Page/directory Page.php"><button class="btn-primary">Browse Alumni</button></a>
      </div>
    </div>

    <div class="stats-strip">
      <div class="stat-item">
        <span class="stat-num">12+</span>
        <span class="stat-label">Alumni Profiles</span>
      </div>
      <div class="stat-item">
        <span class="stat-num">6+</span>
        <span class="stat-label">Industries</span>
      </div>
      <div class="stat-item">
        <span class="stat-num">100%</span>
        <span class="stat-label">Authentic Advice</span>
      </div>
    </div>

  </main>
<!-- --------------------------------------------------------------------------------------------------------------------- -->   

<!-- -- Footer ------------------------------- -->
  
<?php
include "../Header_Footer/Footer.php";
?>

<script src="script.js"></script>
</body>
</html>