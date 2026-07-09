<?php
include '../db.php';

$query = "ALTER TABLE alumni ADD COLUMN document_path VARCHAR(255) DEFAULT NULL";
if (mysqli_query($conn, $query)) {
    echo "Column added successfully.\n";
} else {
    echo "Error: " . mysqli_error($conn) . "\n";
}

$query = "ALTER TABLE alumni ADD COLUMN student_id VARCHAR(50) DEFAULT NULL";
if (mysqli_query($conn, $query)) {
    echo "Column student_id added successfully.\n";
} else {
    echo "Error: " . mysqli_error($conn) . "\n";
}

$query = "ALTER TABLE alumni ADD COLUMN industry VARCHAR(150) DEFAULT NULL";
if (mysqli_query($conn, $query)) {
    echo "Column industry added successfully.\n";
} else {
    echo "Error: " . mysqli_error($conn) . "\n";
}
?>
