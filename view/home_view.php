<?php

include '../functions/home_fxn.php';
include '../settings/connection.php';
include '../settings/core.php';

checkLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: pink;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 2em;
        }

        .statistic-box {
            width: 200px;
            height: 150px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 1em;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .statistic-box:hover {
            background-color: #f0f0f0;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .flex-column {
            flex-direction: column;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .gap-1 {
            gap: 4px;
        }

        .gap-2 {
            gap: 8px;
        }

        .gap-3 {
            gap: 12px;
        }

        .gap-4 {
            gap: 16px;
        }

        .gap-5 {
            gap: 20px;
        }

        .gap-6 {
            gap: 24px;
        }

        .gap-7 {
            gap: 32px;
        }

        .gap-8 {
            gap: 32px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Chore Management Dashboard</h1>
        <?php
        if (checkUserRole() != 3) {
            echo "<a href='../admin/assign_chore_view.php'><button>Assign Chore</button></a>";
            echo "<a href='../admin/chore_control_view.php'><button>Chore Control</button></a>";
        } ?>
        <button onclick="window.location.href = '../Login/Logout_view.php';">Logout</button>

    </header>

    <div class="dashboard-container">
        <a href="#">
            <div class="statistic-box">
                <h2>In Progress</h2>
                <p><?php
                    echo getCount('inProgress');
                    ?>
                </p>
            </div>
        </a>

        <a href="#">
            <div class="statistic-box">
                <h2>Incomplete</h2>
                <p><?php

                    echo getCount('incomplete');
                    ?>
                </p>
            </div>
        </a>

        <a href="#">
            <div class="statistic-box">
                <h2>Completed</h2>
                <p><?php
                    echo getCount('completed');
                    ?>
                </p>
            </div>
        </a>

        <a href="#">
            <div class="statistic-box">
                <h2>All Chores</h2>
                <p><?php
                    echo getCount('assignment');
                    ?>
                </p>
            </div>
        </a>
    </div>

    <div class="flex flex-column gap-2 recently-assigned">
        <div class="flex items-center justify-between">
            <h5>Recently Assigned Chores</h5>
            <a href="" class="text-sm">View assigned chores</a>
        </div>
        <?php
        echo showRecent();
        ?>
    </div>
    </div>
    </div>

    <footer>
        <p>&copy; 2024 Chore Management System</p>
    </footer>

</body>

</html>

<!-- all the above is working: push to github -->