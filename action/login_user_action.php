<?php
session_start();
include '../settings/connection.php';

$response = array('error' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT pid, passwd, rid FROM People WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($pid, $hashedPassword, $rid);

            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['pid'] = $pid;
                $_SESSION['rid'] = $rid;

                // header("Location: ./../view/welcome-page-users.php");
                // exit();
            } else {
                $response['error'] = true;
                $response['message'] = "Incorrect username or password.";
            }
        } else {
            $response['error'] = true;
            $response['message'] = "User not registered or incorrect username.";
        }

        $stmt->close();
    } else {
        $response['error'] = true;
        $response['message'] = "Error: Unable to prepare statement. Please try again.";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Wrong request method. Please try again.";
}

$conn->close();

echo json_encode($response);