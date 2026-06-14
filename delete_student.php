<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: display_students.php?deleted=success");
    } else {
        echo "Error deleting: " . mysqli_error($conn);
    }
} else {
    header("Location: display_students.php");
}
?>