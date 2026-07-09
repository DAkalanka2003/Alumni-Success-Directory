<?php
include '../db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM alumni WHERE id = $id";
$result = mysqli_query($conn, $query);
$alumini = $result ? mysqli_fetch_assoc($result) : null;

if (!$alumini) {
    die("Alumni profile not found.");
}
?>
<?php
$expertise_query = "
    SELECT expertise.name
    FROM expertise
    INNER JOIN alumni_expertise 
        ON expertise.id = alumni_expertise.expertise_id
    WHERE alumni_expertise.alumni_id = $id
";

$expertise_result = mysqli_query($conn, $expertise_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Success Directory</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">

    <link rel="stylesheet" type="text/css"  href="style.css">
</head>
<body>
    <?php 
        include "../Header_Footer/Header.php";
    ?>
    <!-- -------------------------------------------- -->

    <main class="profile-wrap">

    <div class = "content-profile">
        <img src="../Images/<?php echo htmlspecialchars($alumini['profile_image']); ?>" alt="profile Picture">
        <div class = "content-text">
            <span id="name"><?php echo htmlspecialchars($alumini['full_name']);?> </span>
            <span id = "position"><?php echo htmlspecialchars($alumini['job_title']); ?></span>
            <span id="company"><?php echo htmlspecialchars($alumini['company']) . " · " . htmlspecialchars($alumini['company_location']); ?> </span>  
            <span id = "mini-bio"><?php echo htmlspecialchars($alumini['mini_bio']); ?></span>
            <div class="buttons">
                <a href="<?php echo htmlspecialchars($alumini['linkedin']); ?>" target="_blank" class="btn-gold">
                    <i class="ti ti-brand-linkedin" aria-hidden="true"></i> Connect on LinkedIn
                </a>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo htmlspecialchars($alumini['email']) ?>" target="_blank" class="btn-outline">
                    <i class="ti ti-mail" aria-hidden="true"></i> Send Message
                </a>
                <a href="../Directory Page/directory.php"  class="btn-outline">
                    <i class="ti ti-arrow-left" aria-hidden="true"></i> Back to Directory
                </a>
            </div>
        </div>
    </div>
    <hr>

    <div class ="stat">
        <div class = "block">
            <p class="num"><?php echo htmlspecialchars($alumini['graduation_year']) ?></p>
            <p class ="text">Graduation Year</p>
        </div>
        <div class = "block">
            <p class="num"><?php echo htmlspecialchars($alumini['experience_years']) ?></p>
            <p class ="text">Years Experience</p>
        </div>
        <div class = "block">
            <p class="num"><?php echo htmlspecialchars($alumini['companies_worked']) ?></p>
            <p class ="text">companies</p>
        </div>
        <div class = "block">
            <p class="num"><?php echo htmlspecialchars($alumini['publications_count']) ?></p>
            <p class ="text">publications</p>
        </div>
    </div>
    <div class = "content">
        <div class = "content-main">
            <div class="about">
                <p class="title">ABOUT</p>
                <p><?php echo htmlspecialchars($alumini['about_description']) ?></p>
            </div>
            <br>
            <div class="advice">
                <p class ="title">ADVICE FOR STUDENTS</p>
                <div class="advice-box">
                    <i class="ti ti-quote advice-quote-icon" aria-hidden="true"></i>
                    <p class="advice-content"><?php echo htmlspecialchars($alumini['advice']) ?></p>
                </div>
            </div>
            <br>
            <div class="section">
                <p class="title">AREAS OF EXPERTISE</p>
                <div class="tag-cloud">
                    <?php while($expertise = mysqli_fetch_assoc($expertise_result)): ?>
                        <span class="tag"><?= htmlspecialchars($expertise['name']) ?></span>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        
                                               
        <div class="content-sideline">
                <div class="sidebar-card">
                    <p class="sc-title">Academic Background</p>

                <div class="info-row">
                    <i class="ti ti-certificate" aria-hidden="true"></i>
                    <div>
                        <p class="info-val"><?php echo htmlspecialchars($alumini['degree_programme']); ?></p>
                        <p class="info-lbl">Degree</p>
                    </div>
                </div>

                <div class="info-row">
                    <i class="ti ti-building-arch" aria-hidden="true"></i>
                    <div>
                        <p class="info-val"><?php echo htmlspecialchars($alumini['faculty']); ?></p>
                        <p class="info-lbl">Faculty</p>
                    </div>
                </div>

                <div class="info-row">
                    <i class="ti ti-school" aria-hidden="true"></i>
                    <div>
                        <p class="info-val"><?php echo htmlspecialchars($alumini['university']); ?></p>
                        <p class="info-lbl">Institution</p>
                    </div>
                </div>

                <div class="info-row">
                    <i class="ti ti-calendar" aria-hidden="true"></i>
                    <div>
                        <p class="info-val">Class of <?php echo htmlspecialchars($alumini['graduation_year']); ?></p>
                        <p class="info-lbl">Graduation</p>
                    </div>
                </div>

                <div class="info-row">
                    <i class="ti ti-map-pin" aria-hidden="true"></i>
                    <div>
                        <p class="info-val"><?php echo htmlspecialchars($alumini['company_location']); ?></p>
                        <p class="info-lbl">Current Location</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </main>

    <!-- -- Footer ------------------------------- -->
    <?php 
        include "../Header_Footer/Footer.php";
     ?>
</body>
</html>