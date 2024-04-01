<?php

include '../action/get_all_assignment_action.php';

$assignments = getAllAssignments();

if ($assignments->num_rows > 0) {
    $table = '';
    while ($row = $assignments->fetch_assoc()) {
        $table .= '<tr><td>' . $row['chorename'] . '</td><td>' . $row['fname'] . ' ' . $row['lname'] . '</td><td>' . $row['date_assign'] . '</td><td>' . $row['date_due'] . '</td><td>' . $row['sname'] . '</td><td class = "actions"><a href="assignmentid=' . $row['assignmentid'] . '" class="editAssign">📝</a> <a href="#" class="mark-complete">✔️</a> <a href="../action/delete_assignment_action.php?assignmentid=' . $row['assignmentid'] . '" class="delete" id = "delete-button">🚮</a></td></tr>';
    }
    echo $table;
} else {
    echo '<tr><td colspan="6">' . "No assignments in database" . '</td></tr>';
}