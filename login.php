<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
	<h1>Login Form</h1>
	<form class="fitdiv" name="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="email">Email:</label>
		<input type="email" name="email"><br>

		<label for="password">Last Name:</label>
		<input type="password" name="password"><br>

		<input type="submit" value="Login">
	</form>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Get form data
			$email = $_POST["email"];
			$last = $_POST["password"];

			// Connect to database
			$servername = "localhost";
			$username = "root";
			$password = "root";
			$dbname = "webbook";

			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			// Check if email and password are valid
			$sql = "SELECT * FROM customers WHERE email='$email' AND last='$last'";
            error_log($sql, 3, "myapp.log");
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Login successful, redirect to dashboard
                session_start();
                $row = $result->fetch_assoc();
                $_SESSION['username'] = $row['first'];
				header("Location: index.html");
				exit;
			} else {
				echo "<script>alert('Invalid email or password.')</script>";
			}

			$conn->close();
		}
	?>
</body>
</html>
