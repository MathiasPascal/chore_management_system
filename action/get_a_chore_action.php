<?php
include '../settings/connection.php';

function getChoreById($choreId)
{
    global $conn;
    $chore = array();

    $sql = "SELECT * FROM Chores WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $choreId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $chore = $result->fetch_assoc();
    }

    $stmt->close();
    return $chore;
}
?>