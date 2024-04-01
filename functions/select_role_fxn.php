<?php
include '../settings/connection.php';

function selectRoleDropdown()
{
    global $conn;
    $sql = "SELECT * FROM Family_name";
    $result = $conn->query($sql);

    if ($result) {
        $dropdownOptions = '';
        while ($row = $result->fetch_assoc()) {
            $dropdownOptions .= '<option value="' . $row['fam_name'] . '">' . $row['fam_name'] . '</option>';
        }
        return $dropdownOptions;
    } else {
        return false;
    }
}
?>