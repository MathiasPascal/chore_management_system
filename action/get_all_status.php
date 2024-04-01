<?php

include_once '../settings/connection.php';

function getStatus()
{
    global $conn;
    $sql = "SELECT * FROM status";
    $result = $conn->query($sql);
    return $result;
}