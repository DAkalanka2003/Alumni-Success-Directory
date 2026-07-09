<?php
include '../db.php';

/*
 * ⚠️ TODO - SECURITY: Same as Profile_Edit.php - no login check here either.
 * Anyone can POST to this file with any id and overwrite that alumni's data.
 * Add the same session check here once your login system is wired up.
 */

if (!isset($_GET['id'])) {
    die("Error: Alumni ID not provided.");
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $job_title = $_POST['job_title'] ?? '';
    $company = $_POST['company'] ?? '';
    $company_location = $_POST['company_location'] ?? '';
    $mini_bio = $_POST['mini_bio'] ?? '';
    $degree_programme = $_POST['degree_programme'] ?? '';
    $faculty = $_POST['faculty'] ?? '';
    $university = $_POST['university'] ?? '';
    $graduation_year = isset($_POST['graduation_year']) ? intval($_POST['graduation_year']) : null;
    $experience_years = isset($_POST['experience_years']) ? intval($_POST['experience_years']) : null;
    $companies_worked = isset($_POST['companies_worked']) ? intval($_POST['companies_worked']) : null;
    $publications_count = isset($_POST['publications_count']) ? intval($_POST['publications_count']) : null;
    $about_description = $_POST['about_description'] ?? '';
    $advice = $_POST['advice'] ?? '';
    $linkedin = $_POST['linkedin'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Handle Image Upload
    $profile_image = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['profile_image']['tmp_name'];
        $orig_name = basename($_FILES['profile_image']['name']);
        $upload_dir = '../Images/';

        // Only allow real image files - block .php, .html, etc. disguised as images
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($orig_name, PATHINFO_EXTENSION));

        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($ext, $allowed_ext)) {
            die("Error: Only JPG, PNG, GIF or WEBP images are allowed.");
        }

        if ($_FILES['profile_image']['size'] > $max_size) {
            die("Error: Image must be smaller than 5MB.");
        }

        // Confirm the file is actually an image, not just renamed
        $check = getimagesize($tmp_name);
        if ($check === false) {
            die("Error: Uploaded file is not a valid image.");
        }

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Generate a unique, safe filename instead of trusting the original name
        $img_name = 'alumni_' . $id . '_' . uniqid() . '.' . $ext;
        $target_file = $upload_dir . $img_name;

        // Move the uploaded file to the Images directory
        if (move_uploaded_file($tmp_name, $target_file)) {
            $profile_image = $img_name; // Only save the name in the database
        }
    }

    // Update the alumni record
    if ($profile_image) {
        $query = "UPDATE alumni SET 
            full_name=?, job_title=?, company=?, company_location=?, mini_bio=?, 
            degree_programme=?, faculty=?, university=?, graduation_year=?, 
            experience_years=?, companies_worked=?, publications_count=?, 
            about_description=?, advice=?, linkedin=?, email=?, profile_image=? 
            WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssiiiisssssi", 
            $full_name, $job_title, $company, $company_location, $mini_bio, 
            $degree_programme, $faculty, $university, $graduation_year, 
            $experience_years, $companies_worked, $publications_count, 
            $about_description, $advice, $linkedin, $email, $profile_image, $id);
    } else {
        $query = "UPDATE alumni SET 
            full_name=?, job_title=?, company=?, company_location=?, mini_bio=?, 
            degree_programme=?, faculty=?, university=?, graduation_year=?, 
            experience_years=?, companies_worked=?, publications_count=?, 
            about_description=?, advice=?, linkedin=?, email=? 
            WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssiiiissssi", 
            $full_name, $job_title, $company, $company_location, $mini_bio, 
            $degree_programme, $faculty, $university, $graduation_year, 
            $experience_years, $companies_worked, $publications_count, 
            $about_description, $advice, $linkedin, $email, $id);
    }
    
    mysqli_stmt_execute($stmt);

    // Update user credentials
    if (!empty($username)) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $user_update_query = "UPDATE users SET username=?, password=? WHERE alumni_id=?";
            $u_stmt = mysqli_prepare($conn, $user_update_query);
            mysqli_stmt_bind_param($u_stmt, "ssi", $username, $hashedPassword, $id);
            mysqli_stmt_execute($u_stmt);
        } else {
            $user_update_query = "UPDATE users SET username=? WHERE alumni_id=?";
            $u_stmt = mysqli_prepare($conn, $user_update_query);
            mysqli_stmt_bind_param($u_stmt, "si", $username, $id);
            mysqli_stmt_execute($u_stmt);
        }
    }

    // Update Expertise tags
    if (isset($_POST['expertise_list']) && !empty($_POST['expertise_list'])) {
        $tags = json_decode($_POST['expertise_list'], true);
        
        if (is_array($tags)) {
            // Remove existing expertise mappings for this alumni
            $del_query = "DELETE FROM alumni_expertise WHERE alumni_id=?";
            $del_stmt = mysqli_prepare($conn, $del_query);
            mysqli_stmt_bind_param($del_stmt, "i", $id);
            mysqli_stmt_execute($del_stmt);

            // Add new expertise mappings
            foreach ($tags as $tag) {
                $tag = trim($tag);
                if (empty($tag)) continue;

                // Check if expertise already exists in the database
                $check_exp = "SELECT id FROM expertise WHERE name=?";
                $check_stmt = mysqli_prepare($conn, $check_exp);
                mysqli_stmt_bind_param($check_stmt, "s", $tag);
                mysqli_stmt_execute($check_stmt);
                $res = mysqli_stmt_get_result($check_stmt);
                
                if ($row = mysqli_fetch_assoc($res)) {
                    $exp_id = $row['id'];
                } else {
                    // Insert new expertise
                    $ins_exp = "INSERT INTO expertise (name) VALUES (?)";
                    $ins_stmt = mysqli_prepare($conn, $ins_exp);
                    mysqli_stmt_bind_param($ins_stmt, "s", $tag);
                    mysqli_stmt_execute($ins_stmt);
                    $exp_id = mysqli_insert_id($conn);
                }

                // Map expertise to alumni
                $ins_alumni_exp = "INSERT INTO alumni_expertise (alumni_id, expertise_id) VALUES (?, ?)";
                $ins_alumni_exp_stmt = mysqli_prepare($conn, $ins_alumni_exp);
                mysqli_stmt_bind_param($ins_alumni_exp_stmt, "ii", $id, $exp_id);
                mysqli_stmt_execute($ins_alumni_exp_stmt);
            }
        }
    }

    // Redirect back to edit page or success page
    header("Location: Profile Edit.php?id=" . $id . "&status=success");
    exit();
}
?>