<?php

function readAllToDoTasks(){
    global $connection;
    $query = "SELECT * FROM tasks WHERE done_task = 0";
    $allTasksQuery = mysqli_query($connection,$query);
    if(!$allTasksQuery) die("QUERY FAILED");

    while($row=mysqli_fetch_assoc($allTasksQuery)){
        $id_task = $row['id_task'];
        $title_task = $row['title_task'];

        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>$title_task";
        echo "<div class='d-flex flex-row-reverse'><a href='index.php?taskToDelete=$id_task'><span class='badge bg-danger rounded-pill m-1'>&#10007</span></a>";
        echo "<a href='index.php?taskToUpdate=$id_task'><span class='badge bg-warning rounded-pill m-1'>&#9998</span>";
        echo "<a href='index.php?taskToChange=$id_task'><span class='badge bg-success rounded-pill m-1'>&#10004</span></a></div></li>";
    }
}

function readAllDoneTasks(){
    global $connection;
    $query = "SELECT * FROM tasks WHERE done_task != 0";
    $allTasksQuery = mysqli_query($connection,$query);
    if(!$allTasksQuery) die("QUERY FAILED");

    while($row=mysqli_fetch_assoc($allTasksQuery)){
        $id_task = $row['id_task'];
        $title_task = $row['title_task'];

        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>$title_task";
        echo "<div class='d-flex flex-row-reverse'><a href='index.php?taskToDelete=$id_task'>";
        echo "<span class='badge bg-danger rounded-pill m-1'>&#10007</span></a></div></li>";
    }
}

function changeTaskStatus(){
    global $connection;
    if(isset($_GET['taskToChange'])){
        $idTask = $_GET['taskToChange'];
        $query = "UPDATE tasks SET done_task = 1 WHERE id_task = $idTask";

        $changeStatusQuery = mysqli_query($connection,$query);

        if(!$changeStatusQuery) die("QUERY FAILED");
        header("Location: index.php");
    }
}

function deleteTask(){
    global $connection;

    if(isset($_GET['taskToDelete'])){
        $idTask = $_GET['taskToDelete'];
        $query = "DELETE FROM tasks WHERE id_task = $idTask";

        $deleteTaskQuery = mysqli_query($connection,$query);

        if(!$deleteTaskQuery) die("QUERY FAILED");
        header("Location: index.php");
    }
}

function createTask(){
    global $connection;
    if(isset($_POST['submit'])){
        $newTitleTask = $_POST['task'];

        $query = "INSERT INTO tasks (title_task) VALUES ('$newTitleTask')";

        $addTaskQuery=mysqli_query($connection,$query);

        if(!$addTaskQuery) die("QUERY FAILED");
    }
}