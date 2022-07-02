<?php ob_start(); ?>
<?php include "database.php" ?>
<?php include "functions.php" ?>
<?php changeTaskStatus(); ?>
<?php deleteTask(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>To do list</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1>TO DO</h1>
                    <?php
                        if(isset($_GET['taskToUpdate'])){
                        $idEditTask = $_GET['taskToUpdate'];
                        $query="SELECT * FROM tasks WHERE id_task = $idEditTask";
                        $taskToEditQuery = mysqli_query($connection,$query);
                        
                        if(!$taskToEditQuery) die("QUERY FAILED");

                        while($row = mysqli_fetch_assoc($taskToEditQuery)){
                            $titleEditTask=$row['title_task'];
                    ?>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="editTask" placeholder="Edit task" aria-label="Edit task" aria-describedby="button-addon2" value="<?php echo $titleEditTask;?>">
                            <button class="btn btn-outline-secondary" type="submit" name="edit" id="button-addon2">Edit task</button>
                        </div>
                    </form>
                    <?php
                        }}else{
                            ?>

                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="task" placeholder="Add new task" aria-label="Add new task" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2">Add task</button>
                        </div>
                    </form>
                    <?php
                        }
                    ?>
                    <?php
                        if(isset($_POST['edit'])){
                            $newTitle=$_POST['editTask'];
                            $query="UPDATE tasks SET title_task = '$newTitle' WHERE id_task = $idEditTask";
                            $editTaskQuery = mysqli_query($connection,$query);
                            if(!$editTaskQuery) die("QUERY FAILED");
                            header("Location: index.php");
                        }
                    ?>
                <?php createTask(); ?>
                    <ul class="list-group">
                        <?php readAllToDoTasks(); ?>
                    </ul>
            </div>
            <div class="col">
                <h1>ALREADY DONE</h1>
                <ul class="list-group">
                    <?php readAllDoneTasks(); ?>
                </ul>
            </div>
        </div>
        </div>
    </body>
</html>