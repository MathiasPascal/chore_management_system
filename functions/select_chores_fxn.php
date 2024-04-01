<?php

include_once '../settings/connection.php';

function getChores()
{
    global $conn;
    $sql = "SELECT cid, chorename FROM chores";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dropdownOptions = '';
        while ($row = $result->fetch_assoc()) {
            $dropdownOptions .= '<option value="' . $row['cid'] . '">' . $row['chorename'] . '</option>';
        }
        return $dropdownOptions;
    } else {
        return '<option value="' . ' disabled selected">' . "No chores in database" . '</option>';
    }
}