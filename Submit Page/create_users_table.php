<?php
include '../db.php';

$query = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alumni_id INT NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('alumni','admin') DEFAULT 'alumni',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_user_alumni
    FOREIGN KEY (alumni_id)
    REFERENCES alumni(id)
    ON DELETE CASCADE
);";

if (mysqli_query($conn, $query)) {
    echo "Table users created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}
?>
