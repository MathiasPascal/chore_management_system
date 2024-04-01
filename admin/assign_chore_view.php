<?php
include '../functions/select_people_fxn.php';
include '../functions/select_chores_fxn.php';
include '../settings/core.php';

checkLogin();

if (checkUserRole() == 3) {
    header("Location: ./../view/home_view.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chore Management Page</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        .chore-management-table-container {
            margin: 2em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1em;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        .actions {
            display: flex;
            justify-content: space-around;
        }

       
        .modal .modal-body {
            position: absolute;
            inset: 0;
            min-width: 25rem;
            width: fit-content;
            height: fit-content;
            margin: auto;
            padding: 2rem;
            background-color: white;
            border-radius: 4px;

        }

        .modal button,
        .modal input {
            padding: 0.7rem;
        }

        .modal .close {
            padding: 4px;
            background-color: transparent;
            border: none;
        }

        .hidden {
            display: none;
        }

        .modal .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }
    </style>
    <style href="../css/assign_chore_style.css"></style>
</head>

<body>

    <header>
        <h1>Chore Management Dashboard</h1>
        <button onclick="window.location.href = '../view/home_view.php';">Home</button>
        <?php
        if (checkUserRole() != 3) {
            echo "<a href='../admin/assign_chore_view.php'><button>Assign Chore</button></a>";
            echo "<a href='../admin/chore_control_view.php'><button>Chore Control</button></a>";
        } ?>
        <button onclick="window.location.href = '../Login/Logout_view.php';">Logout</button>

    </header>

    <div class="chore-management-table-container overlay">
        <h2>Chore Assignments</h2> <button><a href="#" onClick="document.getElementById('assignModal').classList.remove('hidden')">Assign Chore</a></button>
        <table>
            <thead>
                <tr>
                    <th>Chore Name</th>
                    <th>Person Assigned</th>
                    <th>Date Assigned</th>
                    <th>Due Date</th>
                    <th>Chore Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../functions/get_all_assignment_fxn.php';
                ?>
            </tbody>
        </table>

        <div id="assignModal" class="modal hidden">
            <div class="overlay"></div>
            <div class="modal-body flex flex-column gap-4">
                <div class="header flex flex-column gap-4">
                    <div class="flex items-center justify-between">
                        <h3>Assign a chore</h3>
                        <button class="close" onclick="document.getElementById('assignModal').classList.add('hidden')" id="modal-close-btn">
                            X
                        </button>
                    </div>
                    <hr>
                </div>
                <div class="flex flex-column gap-4 w-full">
                    <form action="" class="flex flex-column gap-4">
                        <div class="w-full flex flex-column gap-2">
                            <label for="assignee" class="text-sm">Asignee</label>
                            <select class="w-full" name="assignee" id="assignee_id" required>
                                <option value="" disable selected>Assign person</option>
                                <?php echo getPeople(); ?>
                            </select>
                        </div>
                        <div class="w-full flex flex-column gap-2">
                            <label for="chore_selected" class="text-sm">Assign Chore</label>
                            <select class="w-full" name="chore_assigned" id="chore_assigned">
                                <option value="" disable selected>Assign Chore</option>
                                <?php echo getChores(); ?>
                            </select>
                        </div>
                        <div class="w-full flex flex-column gap-2">
                            <label for="" class="text-sm">Due Date</label>
                            <input type="date" class="w-full" id="due_date" placeholder="Chore name">
                        </div>
                        <button>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    

    <script>
        function editChoreAssignment(choreId) {
            // Add logic for editing chore assignment with the specified ID
            alert("Edit Chore Assignment with ID: " + choreId);
        }

        function markChoreComplete(choreId) {
            // Add logic for marking chore as complete with the specified ID
            alert("Mark Chore as Complete with ID: " + choreId);
        }

        function markChoreIncomplete(choreId) {
            // Add logic for marking chore as incomplete with the specified ID
            alert("Mark Chore as Incomplete with ID: " + choreId);
        }

        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault();

                var pid = document.getElementById('assignee_id').value;
                var cid = document.getElementById('chore_assigned').value;
                var date = document.getElementById('due_date').value;

                console.log(pid, cid, date);

                $.ajax({
                    url: '../action/assign_a_chore_action.php',
                    type: 'POST',
                    data: {
                        pid: pid,
                        cid: cid,
                        date: date
                    },
                    success: function(response) {
                        if (response === "1") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Chore assigned successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#modal-close-btn').click();
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to assign chore',
                                text: "Try again later",
                                showConfirmButton: false,
                                timer: 6000
                            });
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.delete').click(function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var assignmentid = url.split('=')[1];
                console.log(assignmentid);
                $.ajax({
                    url: '../action/delete_assignment_action.php',
                    type: 'GET',
                    data: {
                        assignmentid: assignmentid
                    },
                    success: function(response) {
                        if (response === "1") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Assignment deleted successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to delete chore',
                                text: response,
                                showConfirmButton: false,
                                timer: 6000
                            });
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>