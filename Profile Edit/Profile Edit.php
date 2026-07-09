<?php
include '../db.php';

/*
 * ⚠️ TODO - SECURITY: This page currently has NO login check.
 * Right now, ANYONE can open Profile_Edit.php?id=<any number> and edit
 * that alumni's profile without logging in. Before this goes live, add
 * a session check here, e.g.:
 *
 *   session_start();
 *   if (!isset($_SESSION['alumni_id']) || $_SESSION['alumni_id'] != $id) {
 *       header("Location: ../Login Page/login.php");
 *       exit();
 *   }
 *
 * Send over your login.php / session code and this can be wired up properly.
 */

$id = intval($_GET['id']);

// Get alumni data safely
$query = "SELECT * FROM alumni WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$alumini = mysqli_fetch_assoc($result);

if (!$alumini) {
    die("Alumni profile not found.");
}

// Get user data (username)
$user_query = "SELECT username FROM users WHERE alumni_id = ?";
$user_stmt = mysqli_prepare($conn, $user_query);
mysqli_stmt_bind_param($user_stmt, "i", $id);
mysqli_stmt_execute($user_stmt);
$user_result = mysqli_stmt_get_result($user_stmt);
$user_data = mysqli_fetch_assoc($user_result);
$current_username = $user_data ? $user_data['username'] : '';
// Get expertise data
$expertise_query = "SELECT expertise.name
                    FROM expertise
                    INNER JOIN alumni_expertise 
                    ON expertise.id = alumni_expertise.expertise_id
                    WHERE alumni_expertise.alumni_id = ?";

$stmt2 = mysqli_prepare($conn, $expertise_query);
mysqli_stmt_bind_param($stmt2, "i", $id);
mysqli_stmt_execute($stmt2);
$expertise_result = mysqli_stmt_get_result($stmt2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alumni Profile</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>

<?php include "../Header_Footer/Header.php"; ?>

<form action="update_profile.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">

<div class="edit-wrap">

    <div class="edit-head">
        <div>
            <p class="edit-title">Edit Your Profile</p>
        </div>
    </div>

    <!-- Profile Photo -->
    <div class="edit-photo-row">
        <div class="photo-frame">
            <img src="../Images/<?php echo htmlspecialchars($alumini['profile_image']); ?>" alt="Current profile photo">
        </div>

        <div class="photo-meta">
            <p class="photo-meta-title">Profile photo</p>
            <p class="photo-meta-sub"> Image: JPG or PNG</p>

            <div class="photo-btns">
                <label for="upload" class="btn-tiny">Upload Photo</label>
                <input id="upload" type="file" name="profile_image" hidden>
            </div>
        </div>
    </div>

    <div class="form-body">

        <!-- MAIN COLUMN -->
        <div class="main-col">

            <!-- Basic Info -->
            <div class="section">
                <p class="sec-label">Basic Information</p>

                <div class="field-grid">

                    <div class="field">
                        <label>Full Name</label>
                        <input type="text" name="full_name"
                               value="<?php echo htmlspecialchars($alumini['full_name']); ?>">
                    </div>

                    <div class="field">
                        <label>Job Title</label>
                        <input type="text" name="job_title"
                               value="<?php echo htmlspecialchars($alumini['job_title']); ?>">
                    </div>

                    <div class="field">
                        <label>Company</label>
                        <input type="text" name="company"
                               value="<?php echo htmlspecialchars($alumini['company']); ?>">
                    </div>

                    <div class="field">
                        <label>Company Location</label>
                        <input type="text" name="company_location"
                               value="<?php echo htmlspecialchars($alumini['company_location']); ?>">
                    </div>
                </div>

                <div class="field-grid full">
                    <div class="field">
                        <label>Mini Bio</label>
                        <textarea name="mini_bio" rows="2"><?php echo htmlspecialchars($alumini['mini_bio']); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Academic -->
            <div class="section">
                <p class="sec-label">Academic Background</p>

                <div class="field-grid">

                    <div class="field">
                        <label>Degree / Programme</label>
                        <input type="text" name="degree_programme"
                               value="<?php echo htmlspecialchars($alumini['degree_programme']); ?>">
                    </div>

                    <div class="field">
                        <label>Faculty</label>
                        <input type="text" name="faculty"
                               value="<?php echo htmlspecialchars($alumini['faculty']); ?>">
                    </div>

                    <div class="field">
                        <label>University</label>
                        <input type="text" name="university"
                               value="<?php echo htmlspecialchars($alumini['university']); ?>">
                    </div>

                    <div class="field">
                        <label>Graduation Year</label>
                        <input type="number" name="graduation_year"
                               value="<?php echo htmlspecialchars($alumini['graduation_year']); ?>">
                    </div>
                </div>
            </div>

            <!-- Career Stats -->
            <div class="section">
                <p class="sec-label">Career Stats</p>

                <div class="stats-grid">

                    <div class="field">
                        <label>Years Exp.</label>
                        <input type="number" name="experience_years"
                               value="<?php echo htmlspecialchars($alumini['experience_years']); ?>">
                    </div>

                    <div class="field">
                        <label>Companies</label>
                        <input type="number" name="companies_worked"
                               value="<?php echo htmlspecialchars($alumini['companies_worked']); ?>">
                    </div>

                    <div class="field">
                        <label>Publications</label>
                        <input type="number" name="publications_count"
                               value="<?php echo htmlspecialchars($alumini['publications_count']); ?>">
                    </div>

                    <div class="field">
                        <label>Grad Year</label>
                        <input type="number"
                               value="<?php echo htmlspecialchars($alumini['graduation_year']); ?>"
                               disabled>
                    </div>

                </div>
            </div>

            <!-- About -->
            <div class="section">
                <p class="sec-label">About</p>

                <div class="field">
                    <textarea name="about_description" rows="4"><?php echo htmlspecialchars($alumini['about_description']); ?></textarea>
                </div>
            </div>

            <!-- Advice -->
            <div class="section">
                <p class="sec-label">Advice for Students</p>

                <div class="field">
                    <textarea name="advice" rows="3"><?php echo htmlspecialchars($alumini['advice']); ?></textarea>
                </div>
            </div>

            <!-- Dynamic Expertise -->
            <div class="section">
                <p class="sec-label">Areas of Expertise</p>
                <div class="tag-input-row" id="tagContainer">

                    <!-- Existing DB tags -->
                    <?php while($expertise = mysqli_fetch_assoc($expertise_result)): ?>
                        <span class="tag-chip existing-tag">
                            <?php echo htmlspecialchars($expertise['name']); ?>
                            <i class="ti ti-x remove-db-tag"></i>
                        </span>
                    <?php endwhile; ?>

                    <!-- dynamic JS tags will appear here -->
                    <input class="tag-add-input" type="text" id="tagInput" placeholder="Add a skill and press enter">
                </div>

                <!-- hidden field to send data -->
                <input type="hidden" name="expertise_list" id="expertiseList">
                <p class="field-hint">Press enter after typing to add a new tag</p>
            </div>
        </div>


        <!-- SIDEBAR -->
        <aside class="sidebar-col">

            <div class="section">
                <p class="sec-label">Contact & Links</p>

                <div class="field">
                    <label>LinkedIn URL</label>
                    <input type="text" name="linkedin"
                           value="<?php echo htmlspecialchars($alumini['linkedin']); ?>">
                </div>

                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email"
                           value="<?php echo htmlspecialchars($alumini['email']); ?>">
                </div>
            </div>

            <div class="section">
                <p class="sec-label">Account Credentials</p>
                <div class="field">
                    <label>Username</label>
                    <input type="text" name="username"
                           value="<?php echo htmlspecialchars($current_username); ?>">
                </div>
                <div class="field">
                    <label>New Password</label>
                    <input type="password" name="password" >
                </div>
            </div>
        </aside>

    </div>


    <!-- SAVE BAR -->
    <div class="save-bar">
        <a href="../Home Page/Home.php"><button type="button" class="btn-outline">Cancel</button></a>
        <button type="submit" class="btn-gold">Save Changes</button>
    </div>

</div>

</form>

<?php include "../Header_Footer/Footer.php"; ?>

</body>
</html>