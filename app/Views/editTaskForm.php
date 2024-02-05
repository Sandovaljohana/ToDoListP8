<form method="POST" action="index.php">
    <input type="hidden" name="id" value="<?php echo $taskDetails['id']; ?>">
    <label for="newTitle">New Title:</label>
    <input type="text" name="newTitle" value="<?php echo $taskDetails['title']; ?>">
    <br>
    <label for="newTask">New Task:</label>
    <input type="text" name="newTask" value="<?php echo $taskDetails['task']; ?>">
    <br>
    <input type="submit" name="updateTask" value="Update Task">
</form>
