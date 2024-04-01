<?php

include_once '../settings/core.php';

if (isset($_POST['cid']) && isset($_POST['pid']) && isset($_POST['date'])) {
    include_once '../settings/connection.php';
    $pid = $_POST['pid'];
    $cid = $_POST['cid'];
    $date = $_POST['date'];
    $assigner_id = $_SESSION['pid'];
    $query = "INSERT INTO assignment (cid, sid, date_assign, date_due, who_assigned) VALUES (?, 1, CURDATE(), ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $cid, $date, $assigner_id);

    if ($stmt->execute()) {
        $assignmentid = $stmt->insert_id;
        $query = "INSERT INTO assigned_people (pid, assignmentid) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $pid, $assignmentid);
        $stmt->execute();
        echo true;
    } else {
        echo "Error creating assignment: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error: Missing parameters.";
}