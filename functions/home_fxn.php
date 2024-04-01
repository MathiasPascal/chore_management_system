<?php

include '../action/get_all_assignment_action.php';

$incomplete = getAllChoreAssignmentsIncomplete();
$inProgress = getAllChoreAssignmentsInProgress();
$completed = getAllChoreAssignmentsCompleted();
$recent = getRecentChoreAssignments();
$assignments = getAllAssignments();

$incompleteCount = $incomplete->num_rows;
$inProgressCount = $inProgress->num_rows;
$completedCount = $completed->num_rows;
$assignmentCount = $assignments->num_rows;

function getCount($param)
{
    global $incompleteCount, $inProgressCount, $completedCount, $assignmentCount;
    if ($param == 'incomplete') {
        return $incompleteCount;
    } elseif ($param == 'inProgress') {
        return $inProgressCount;
    } elseif ($param == 'completed') {
        return $completedCount;
    } elseif ($param == 'assignment') {
        return $assignmentCount;
    }
}

function showRecent()
{
    global $recent;
    if ($recent->num_rows > 0) {
        while ($row = $recent->fetch_assoc()) {
            echo '<div class="r_card flex gap-5 items-center justify-between">
            <div class="flex gap-4">
                <div class="flex flex-column gap-2">
                    <p class="font-medium">' . $row['chorename'] . '</p>
                    <div class="flex items-center gap-2">
                        <div class="icon">
                            <img width="20" height="20" src="https://img.icons8.com/color/48/person-male.png" alt="person-male"/>
                        </div>
                        <p class="text-sm">' . $row['fname'] . '</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="icon">📅                </div>
                <p class="date_ass text-sm">' . $row['date_assign'] . '</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="icon">
                    📅
                </div>
                <p class="date_comp text-sm">' . $row['date_due'] . '</p>
            </div>
            <a href="" class="text-sm">Chore details</a>
        </div>';
        }
    }
    else{
        echo '<div class="r_card flex gap-5 items-center justify-between">
            <div class="flex gap-4">
                <div class="flex flex-column gap-2">
                    <p class="font-medium">No Chores Marked In Progress</p>
                    <div class="flex items-center gap-2">
                        <div class="icon">
                        </div>
                        <p class="text-sm">'. '</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="icon">               </div>
                <p class="date_ass text-sm">' . '</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="icon">
                    
                </div>
                <p class="date_comp text-sm">' . '</p>
            </div>
            <a href="" class="text-sm"></a>
        </div>';

    }
}