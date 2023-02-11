<?php
$db = mysqli_connect('localhost', 'root', '', 'todo');

if (isset($_POST['submit'])){
  $task=$_POST['task'];

  mysqli_query($db,"INSERT INTO tasks(task) VALUES('$task')");

  header('location:index.php');
}

if (isset($_GET['del_task'])) {
  $id = $_GET['del_task'];

  mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
  header('location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>First Project</title>
  <link rel="stylesheet" href="style123.css">
</head>
<body>
        
  <h2 class="h2">TaskNinja</h2>
  
  <form method="post" action="index.php" class="input_form">
    <input type="text" name="task" class="task_input"  required>
    <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
    
  </form>
  
  <table >
  <thead>
    <tr>
      <th>Task</th>
      <th>Description</th>
      <th>Action</th>
      <th>Progress</th>
    </tr>
  </thead>

  <tbody>
    <?php 
    // select all tasks if page is visited or refreshed
    $tasks = mysqli_query($db, "SELECT * FROM tasks");

    $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
      <tr>
        <td> <?php echo $i; ?> </td>
        <td class="task"> <?php echo $row['task']; ?> </td>
        <td class="delete"> 
          <a href="index.php?del_task=<?php echo $row['id'] ?>">DELETE</a> 
        </td>
        <td class="btn2">
          <button id="myButton_<?php echo $row['id'] ?>">In Progress</button>
        </td>
      </tr>

    <?php $i++; } ?>  
  </tbody>
</table>
<div class="copyright">
  &copy; 2023 MuteeVincent
</div>
<script>
  // This script is for toggling the progress button between "In Progress" and "Completed"
  var buttons = document.querySelectorAll("button[id^='myButton_']");
  buttons.forEach(function(button) {
    button.addEventListener("click", function() {
      if (button.innerHTML === "In Progress") {
        button.innerHTML = "Completed";
		
      } else {
        button.innerHTML = "In Progress";
      }
    });
  });
</script>
</body>
</html>