<?php
include_once '../settings/connection.php';

function getPeople()
{
    global $conn;
    $sql = "SELECT pid, fname, lname FROM People";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dropdownOptions = '';
        while ($row = $result->fetch_assoc()) {
            $dropdownOptions .= '<option value="' . $row['pid'] . '">' . $row['fname'] . ' ' . $row['lname'] . '</option>';
        }
        return $dropdownOptions;
    } else {
        return '<option value="' . ' disabled selected">' . "No people in database" . '</option>';
    }
}