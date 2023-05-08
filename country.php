<!DOCTYPE html>
<html>
<head>
	<title>REST Countries API</title>
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
            <a class="orangecurvebutton" href="register.php">Register</a>
            <a class="orangecurvebutton" href="login.php">Login</a>
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
	<h1>REST Countries API</h1>
	<form method="GET" class="nicediv">
		<label for="search">Search for a country:</label>
		<input type="text" id="search" name="search">
		<button type="submit" class="orangecurvebutton">Search</button>
	</form>

	<?php
		if (isset($_GET['search'])) {
			$search = $_GET['search'];
			$url = "https://restcountries.com/v2/name/$search";
			$data = file_get_contents($url);
			$countries = json_decode($data);

			if (count($countries) > 0) {
				foreach ($countries as $country) {
					echo "<div class='flexcontainer1'>";
					echo "<div class='fulldiv'>";
					echo "<h2>{$country->name}</h2>";
					echo "<p>Capital: {$country->capital}</p>";
					echo "<p>Population: {$country->population}</p>";
					echo "<p>Region: {$country->region}</p>";
					echo "<p>Subregion: {$country->subregion}</p>";
					echo "<p>Language(s): ";
					foreach ($country->languages as $language) {
						echo "{$language->name} ";
					}
					echo "</p>";
					echo "<p>Currency: {$country->currencies[0]->name} ({$country->currencies[0]->symbol})</p>";
					echo "</div>";
					echo "<img class='fitdiv' src='{$country->flag}' alt='Flag of {$country->name}'>";
					echo "</div>";
				}
			} else {
				echo "<p>No results found for '$search'.</p>";
			}
		}
	?>
</body>
</html>
