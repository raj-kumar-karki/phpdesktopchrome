<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize

    // Run delete query safely
    $sql = "DELETE FROM offerrecords WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: offer.php");
        exit; // stop execution after redirect
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // No ID provided
    header("Location: offer.php");
    exit;
}
?>
