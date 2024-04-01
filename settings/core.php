<?php
session_start();

function checkLogin()
{
    if (!isset($_SESSION['pid'])) {
        header("Location: ../index.php");
        die();
    }
}

function checkUserRole()
{
    if (!isset($_SESSION['rid'])) {
        return false;
    }
    return $_SESSION['rid'];
}

function isLoggedIn()
{
    return isset($_SESSION['pid']);
}
?>