<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../db.php';

$formError   = "";
$formSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["profile_submit"])) {

    $name      = trim($_POST["name"] ?? "");
    $year      = trim($_POST["year"] ?? "");
    $studentId = trim($_POST["student_id"] ?? "");
    $company   = trim($_POST["company"] ?? "");
    $role      = trim($_POST["role"] ?? "");
    $username  = trim($_POST["username"] ?? "");
    $password  = $_POST["password"] ?? ""; // hashed below with password_hash

    if (!$name || !$year || !$company || !$role || !$username || !$password) {
        $formError = "Please fill in all required fields.";
    } elseif (empty($_FILES["pdf"]["name"])) {
        $formError = "Please upload a PDF document for validation.";
    } else {
        // Check if username already exists
        $checkStmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
        mysqli_stmt_bind_param($checkStmt, "s", $username);
        mysqli_stmt_execute($checkStmt);
        $res = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($res) > 0) {
            $formError = "Username already exists. Please choose a different one.";
        } else {
            $uploadDirImg = "../Images/";
            $uploadDirPdf = "../upload/";

            if (!is_dir($uploadDirImg)) mkdir($uploadDirImg, 0755, true);
            if (!is_dir($uploadDirPdf)) mkdir($uploadDirPdf, 0755, true);

            $pdfExt = strtolower(pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION));

            if ($pdfExt !== "pdf") {
                $formError = "Proof document must be a PDF file.";
            } else {

                $imageName = ""; // Default empty if no image provided
                $allowedImg = ["jpg", "jpeg", "png"];

                // Handle optional image upload
                if (!empty($_FILES["image"]["name"])) {
                    $imgExt = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                    if (!in_array($imgExt, $allowedImg)) {
                        $formError = "Profile image must be JPG, JPEG or PNG.";
                    } else {
                        $imageName = "img_" . uniqid() . "_" . time() . "." . $imgExt;
                        $imagePath = $uploadDirImg . $imageName;
                        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
                    }
                }

                // If no error occurred during image upload check
                if (!$formError) {
                    $pdfName = "doc_" . uniqid() . "_" . time() . ".pdf";
                    $pdfPath = $uploadDirPdf . $pdfName;

                    if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdfPath)) {
                        $pdfRelativePath = "upload/" . $pdfName;

                        // Insert into alumni table
                        $alumniStmt = mysqli_prepare($conn, "INSERT INTO alumni
                                (full_name, graduation_year, student_id, company, job_title, profile_image, document_path)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
                        mysqli_stmt_bind_param(
                            $alumniStmt, "sssssss",
                            $name, $year, $studentId, $company, $role, $imageName, $pdfRelativePath
                        );

                        if (mysqli_stmt_execute($alumniStmt)) {
                            $alumni_id = mysqli_insert_id($conn);

                            // Insert into users table
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            $userStmt = mysqli_prepare($conn, "INSERT INTO users (alumni_id, username, password) VALUES (?, ?, ?)");
                            mysqli_stmt_bind_param($userStmt, "iss", $alumni_id, $username, $hashedPassword);

                            if (mysqli_stmt_execute($userStmt)) {
                                $formSuccess = true;
                                $_POST = array(); // Clear the fields
                            } else {
                                $formError = "Error creating user account: " . mysqli_error($conn);
                            }
                        } else {
                            $formError = "Something went wrong saving your profile: " . mysqli_error($conn);
                        }
                    } else {
                        $formError = "Error uploading PDF document.";
                    }
                }
            }
        }
    }
}
?>