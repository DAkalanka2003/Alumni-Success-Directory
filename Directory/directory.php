<?php
    include  '../db.php';

    $query = "SELECT * FROM alumni WHERE status !='pending'";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Database query failed: ".mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Success Directory</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css"  href="style.css">
</head>

<body>
<!-- -- Header ------------------------------- -->
    <?php 
        include "../Header_Footer/Header.php";
     ?>
<!-- --------------------------------------------------------------------------------------------------------------------- -->   
<main class="dir-wrap">

    <div class="dir-head">
      <div>
        <div class="dir-badge">ALUMNI NETWORK</div>
        <h1 class="dir-title">Alumni Directory</h1>
        <p class="dir-sub">Browse profiles and connect with alumni across industries</p>
      </div>
    </div>

    <div class="dir-grid">

    <?php if(mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>

        <a class="alum-card" href="../Dir_Profile/profile.php?id=<?php echo $row['id']; ?>">

            <div class="card-photo">
                <img src="../Images/<?php echo htmlspecialchars($row['profile_image']); ?>" alt="<?php echo htmlspecialchars($row['full_name']); ?>">
                <span class="year-badge"><?php echo htmlspecialchars($row['graduation_year']); ?></span>
            </div>

            <div class="card-body">
                <h3 class="alum-name"><?php echo htmlspecialchars($row['full_name']); ?></h3>
                <p class="alum-role"><?php echo htmlspecialchars($row['job_title']); ?></p>
                <p class="alum-company"><?php echo htmlspecialchars($row['company']); ?></p>
            </div>

        </a>

        <?php endwhile; ?>
    <?php else: ?>
        <div class="dir-empty">
            <p>No Alumni Found</p>
        </div>
    <?php endif; ?>

    </div>

</main>
<!-- --------------------------------------------------------------------------------------------------------------------- -->   

<!-- -- Footer ------------------------------- -->
    <?php 
        include "../Header_Footer/Footer.php";
     ?>

</body>
</html>