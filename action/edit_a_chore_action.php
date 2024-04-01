<?php
include '../settings/connection.php';

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choreId = $_POST['choreId'];
    $newChoreName = $_POST['choreName'];

    $sql = "UPDATE Chores SET chorname = ? WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newChoreName, $choreId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response['success'] = true;
        $response['message'] = "Chore updated successfully.";
    } else {
        $response['message'] = "Error updating chore. Please try again.";
    }

    $stmt->close();
} else {
    $response['message'] = "Wrong request method. Please try again.";
}

$conn->close();
echo json_encode($response);
?>