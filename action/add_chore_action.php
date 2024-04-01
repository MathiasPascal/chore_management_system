<?php
include '../settings/connection.php';

$response = array('success' => false, 'message' => '', 'chorname' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choreName = $_POST['choreName'];

    $sql = "INSERT INTO Chores (chorename) VALUES (?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $choreName);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['chore_added'] = true;
        $response['success'] = true;
        $response['message'] = $choreName . " added successfully.";
        $response['chorname'] = $choreName;

    } else {
        $response['message'] = "Error: Unable to add chore. Please try again.";
    }

    $stmt->close();
} else {
    $response['message'] = "Wrong request method. Please try again.";
}

$conn->close();
echo json_encode($response);