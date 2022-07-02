<?php

function readAllToDoTasks(){
    global $connection;
    $query = "SELECT * FROM tasks WHERE done_task = 0";
    $allTasksQuery = mysqli_query($connection,$query);
    if(!$allTasksQuery) die("QUERY FAILED");

    while($row=mysqli_fetch_assoc($allTasksQuery)){
        $id_task = $row['id_task'];
        $title_task = $row['title_task'];
        $done_task = $row['done_task'];
        if($done_task) $status_task = "Done";
        else $status_task = "To do";
        echo "<tr><td>$title_task</td>";
        if(!$done_task) echo "<td><a href='index.php?taskToChange=$id_task'> DONE</a></td>";
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
        $done_task = $row['done_task'];
        if($done_task) $status_task = "Done";
        else $status_task = "To do";
        echo "<tr><td>$title_task</td>";
        echo "<td><a href='index.php?taskToDelete=$id_task'> X</a></td></tr>";
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