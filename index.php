<?php ob_start(); ?>
<?php include "database.php" ?>
<?php include "functions.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>To do list</title>
    </head>
    <body>
            <h1>TO DO</h1>
                <form action="" method="POST">
                    <input class="task" type="text" name="task" placeholder="Add new task">
                    <input class="button" type="submit" name="submit" value="Add task">
                </form>
            <?php createTask(); ?>
                <table>
                    <tbody>
                        <?php readAllToDoTasks(); ?>
                        <?php changeTaskStatus(); ?>
                        <?php deleteTask(); ?>
                    </tbody>
                </table>

            <h1>ALREADY DONE</h1>
                <table>
                    <tbody>
                        <?php readAllDoneTasks(); ?>
                    </tbody>
    </body>
</html>