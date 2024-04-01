<?php
include_once('../settings/core.php');

if (checkUserRole() != 1) {
    echo "Not permitted to use this feature!";
} else {

    if (isset($_GET['assignmentid'])) {
        include_once '../settings/connection.php';
        $assignmentid = $_GET['assignmentid'];
        $query = "DELETE FROM assignment WHERE assignmentid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $assignmentid);

        if ($stmt->execute()) {
            echo true;
        } else {
            echo "Error deleting assignment: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: Missing parameters.";
    }
}