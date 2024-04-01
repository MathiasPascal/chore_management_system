<?php

include_once '../action/get_all_status.php';

function getStatus()
{
    $status = getStatus();
    if ($status->num_rows > 0) {
        $dropdown = '';
        while ($row = $status->fetch_assoc()) {
            $dropdown .= '<option value="' . $row['statusid'] . '">' . $row['sname'] . '</option>';
        }
    } else {
        echo '<option value="">' . "No status in database" . '</option>';
    }
}