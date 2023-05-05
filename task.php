<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
    <link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<html>
    <head>
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/menu.js"></script>
    </head>
    <div class="nav_border flex_cont">
        <img src="images/download.jfif" width="175" height="150">
        <div class="flex_item center_text">
            <h1>Welcome to Dylan's Website!</h1>
            <button id='modebutton' onclick="changeModes()" class="orangecurvebutton">Switch to Dark Mode</button>
        </div>
        <img src="images/current.JPG"  width="150" height="150">
    </div>
    <nav class="flex_cont">

        <div class="flex_item nav_item" onmouseleave="hide()">
            <a onmouseover="show('m1')">Drop Down Link</a> 
            <div id="m1" class="hiddenVis" onmouseover="show('m1')">
              <a href="index.html">Home</a>
              <a href="biography.html">Biography</a>
              <a href="calculator.html">Calculator</a>
              <a href="feedback.html">Feedback</a>
              <a href="country.php">Country API</a>
              <a href="task.php">Task App</a>
            </div>
        </div>

        <div class="flex_item nav_item">
            <a href="index.html">Home</a>
        </div>
        <div class="flex_item nav_item">
            <a href="biography.html">Biography</a>
        </div>
        <div class="flex_item nav_item">
            <a href="calculator.html">Calculator</a>
        </div>
        <div class="flex_item nav_item">
            <a href="feedback.html">Feedback</a>
        </div>
        <div class="flex_item nav_item">
            <a href="country.php">Country API</a>
        </div>
        <div class="flex_item nav_item">
            <a href="task.php">Task App</a>
        </div>
    </nav>
</html>


<body>
	<h1>Todo List</h1>
    <form method="POST" class="flexcontainer1">
	<label for="task">Add Task:</label>
	<input type="text" id="task" name="task">
	<button type="submit" class="orangecurvebutton">Add</button>
</form>

<div class="nicediv">
	<h2>In Progress</h2>
	<?php
		if ($_POST) {
			$task = $_POST['task'];
			$file = fopen("tasks.txt", "a");
			fwrite($file, "in progress:$task\n");
			fclose($file);
		}

		if ($_GET) {
			$id = $_GET['id'];

			$lines = file("tasks.txt");
			$line = $lines[$id];

			if (strpos($line, "in progress:") === 0) {
				$line = str_replace("in progress:", "done:", $line);
				$lines[$id] = $line;
				file_put_contents("tasks.txt", implode("", $lines));
			}
		}

		$tasks = file("tasks.txt");
		echo "<ul>";
		foreach ($tasks as $id => $task) {
			$task = str_replace("\n", "", $task);
			if (strpos($task, "in progress:") === 0) {
				$task = str_replace("in progress:", "", $task);
				echo "<li>$task <a href='?id=$id' class='orangebackcurved'>[DONE]</a></li>";
			}
		}
		echo "</ul>";
	?>
</div>

<div class="nicediv">
	<h2>Completed Tasks</h2>
	<?php
		$tasks = file("tasks.txt");
		echo "<ul>";
		foreach ($tasks as $id => $task) {
			$task = str_replace("\n", "", $task);
			if (strpos($task, "done:") === 0) {
				$task = str_replace("done:", "", $task);
				echo "<li>$task</li>";
			}
		}
		echo "</ul>";
	?>
</div>
</body>
</html>