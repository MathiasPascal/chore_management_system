<?php
include '../settings/connection.php';
function getAllChores()
{
    global $conn;
    $sql = "SELECT * FROM Chores";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $chores = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $chores;
        } else {
            return [];
        }
    } else {
        return false;
    }

    mysqli_close($conn);
}