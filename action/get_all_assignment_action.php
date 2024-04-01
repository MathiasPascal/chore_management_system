<?php

include_once '../settings/connection.php';

function getAllAssignments()
{
    global $conn;
    $sql = "SELECT assignment.assignmentid, assignment.cid, assignment.date_assign, assignment.date_due, assignment.who_assigned, assignment.sid, status.sname, chores.chorename, People.fname, People.lname FROM assignment JOIN chores ON assignment.cid = chores.cid JOIN assigned_people ON assignment.assignmentid = assigned_people.assignmentid JOIN People ON assigned_people.pid = People.pid JOIN status ON assignment.sid = status.sid";
    $result = $conn->query($sql);

    $var_data = $result;

    return $var_data;
}

function getAllChoreAssignmentsInProgress()
{
    global $conn;
    $sql = "SELECT assignment.assignmentid, assignment.cid, assignment.date_assign, assignment.date_due, assignment.who_assigned, assignment.sid, status.sname, chores.chorename, People.fname, People.lname FROM assignment JOIN chores ON assignment.cid = chores.cid JOIN assigned_people ON assignment.assignmentid = assigned_people.assignmentid JOIN People ON assigned_people.pid = People.pid JOIN status ON assignment.sid = status.sid WHERE assignment.sid = 2 AND assignment.date_due >= CURDATE()";
    $result = $conn->query($sql);

    $var_data = $result;

    return $var_data;
}

function getAllChoreAssignmentsCompleted()
{
    global $conn;
    $sql = "SELECT assignment.assignmentid, assignment.cid, assignment.date_assign, assignment.date_due, assignment.who_assigned, assignment.sid, status.sname, chores.chorename, People.fname, People.lname FROM assignment JOIN chores ON assignment.cid = chores.cid JOIN assigned_people ON assignment.assignmentid = assigned_people.assignmentid JOIN People ON assigned_people.pid = People.pid JOIN status ON assignment.sid = status.sid WHERE assignment.sid = 3";
    $result = $conn->query($sql);

    $var_data = $result;

    return $var_data;
}

function getAllChoreAssignmentsIncomplete()
{
    global $conn;
    $sql = "SELECT assignment.assignmentid, assignment.cid, assignment.date_assign, assignment.date_due, assignment.who_assigned, assignment.sid, status.sname, chores.chorename, People.fname, People.lname FROM assignment JOIN chores ON assignment.cid = chores.cid JOIN assigned_people ON assignment.assignmentid = assigned_people.assignmentid JOIN People ON assigned_people.pid = People.pid JOIN status ON assignment.sid = status.sid WHERE assignment.sid = 4 AND assignment.date_due < CURDATE()";
    $result = $conn->query($sql);

    $var_data = $result;

    return $var_data;
}

function getRecentChoreAssignments()
{
    global $conn;
    $sql = "SELECT assignment.assignmentid, assignment.cid, assignment.date_assign, assignment.date_due, assignment.who_assigned, assignment.sid, status.sname, chores.chorename, People.fname, People.lname FROM assignment JOIN chores ON assignment.cid = chores.cid JOIN assigned_people ON assignment.assignmentid = assigned_people.assignmentid JOIN People ON assigned_people.pid = People.pid JOIN status ON assignment.sid = status.sid WHERE assignment.sid = 2 ORDER BY assignment.date_assign DESC LIMIT 3";
    $result = $conn->query($sql);

    $var_data = $result;

    return $var_data;
}