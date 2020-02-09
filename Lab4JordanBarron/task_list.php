<!DOCTYPE html>
<html>
<head>
    <title>Task List Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header>
        <h1>Task List Manager</h1>
    </header>
    <main>
    	<div id="lists">
            <!-- part 1: the task lists form -->
            <h2>List Selection</h2>
            <?php if (count($task_list_names) == 0) : ?>
            <p>There are no task lists.</p>
            <?php else: ?>
            <form action="." method="post" >
                <label>List:</label>
                <select name="listname">
                    <?php foreach($task_list_names as $listname) : ?> <!-- for each value in the task list array -->
                    	<?php if ($listname == $selected_list) : ?> <!-- if the value is equal to the selected item -->
                            <option value="<?php echo $listname; ?>" selected>
                                <?php echo $listname; ?>           <!-- show that item -->
                            </option>
                        <?php else: ?>
                            <option value="<?php echo $listname; ?>"> <!-- other options -->
                                <?php echo $listname; ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <br>
                <label>&nbsp;</label>
                <input type="submit" name="action" value="Select List">
            </form>
            <br>
            <?php endif; ?>
            
            <!-- part 2: the add form for task lists -->
            <h2>Add Task List</h2>
            <form action="." method="post" >
                <label>List:</label>
                <input type="text" name="newlistname" id="newlistname"><br>
                <label>&nbsp;</label>
                <input type="submit" name="action" value="Add List">
            </form>
            <br>
            
            <!-- part 3: clear all data -->
            <form action="." method="post" >
                <input type="submit" name="action" value="Clear All">
            </form>
        </div>
    
    	<div id="tasks">
            <!-- part 4: the errors -->
            <?php if (count($errors) > 0) : ?>
            <h2>Errors</h2>
            <ul>
                <?php foreach($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
            <br>
            <?php endif; ?>    
            
    	<?php if (count($task_list_names) < 1) : ?>
            <p>Add a new list to be managed</p>	
    	<?php else : ?> <!-- Tasks and add tasks will not appear unless there is at least one list -->
            <!-- part 5: the tasks of the selected list -->
        	<h2><?php echo $selected_list ?></h2>
            <?php if (count($task_list) == 0) : ?>
                <p>There are no tasks in the selected task list.</p>
            <?php else: ?>
                <ul>
                <?php foreach($task_list as $id => $task) : ?>
                    <li><?php echo $id + 1 . '. ' . $task; ?></li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <br>
    
            <!-- part 6: the add form for tasks -->
            <h2>Add Task</h2>
            <form action="." method="post" >
                <label>Task:</label>
                <input type="text" name="newtask" id="newtask"><br>
                <label>&nbsp;</label>
                <input type="submit" name="action" value="Add Task">
            </form>
            <br>
        <?php endif; ?>    
    
            <!-- part 7: the delete form for tasks -->
            <?php if (count($task_list) > 0) : ?>  <!-- Delete task only displays if the task list is greater than 0 -->
            <h2>Delete Task</h2>
            <form action="." method="post" >
                <label>Task:</label>
                <select name="taskid">
                    <?php foreach($task_list as $id => $task) : ?>
                        <option value="<?php echo $id; ?>">
                            <?php echo $task; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label>&nbsp;</label>
                <input type="submit" name="action" value="Delete Task">
            </form>
            <?php endif; ?>
        </div>
        
    </main>
</body>
</html>