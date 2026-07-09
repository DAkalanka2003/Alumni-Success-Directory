<?php
session_start();

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "alumni_directory";

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

$loginError = "";
$loginSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login_submit"])) {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $loginError = "Please enter username and password.";
    } else {
        $query = "SELECT users.id, users.alumni_id, users.username, users.password, alumni.status 
                  FROM users 
                  INNER JOIN alumni ON users.alumni_id = alumni.id 
                  WHERE users.username = ?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user["password"])) {
                if ($user['status'] === 'approved') {
                    $_SESSION["user_id"]  = $user["id"];
                    $_SESSION["username"] = $user["username"];

                    header("Location: ../Profile Edit/Profile Edit.php?id=" . $user["alumni_id"]);
                    exit;
                } else if ($user['status'] === 'pending') {
                    $loginError = "Your account is still pending admin approval.";
                } else if ($user['status'] === 'rejected') {
                    $loginError = "Your account submission has been rejected.";
                } else {
                    $loginError = "Your account does not have access.";
                }
            } else {
                $loginError = "Incorrect username or password.";
            }
        } else {
            $loginError = "Incorrect username or password.";
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>