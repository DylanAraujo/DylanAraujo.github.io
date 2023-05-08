<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
	<title>Registration Form</title>
	<script type="text/javascript">
		function validateForm() {
			var email = document.forms["registrationForm"]["email"].value;
			var firstName = document.forms["registrationForm"]["firstName"].value;
			var lastName = document.forms["registrationForm"]["lastName"].value;
			var phone = document.forms["registrationForm"]["phone"].value;

			if (!validateEmail(email)) {
				alert("Please enter a valid email address.");
				return false;
			}

			if (!validatePhone(phone)) {
				alert("Please enter a valid phone number.");
				return false;
			}

			return true;
		}

		function validateEmail(email) {
			var re = /\S+@\S+\.\S+/;
			return re.test(email);
		}

		function validatePhone(phone) {
			var re = /^[0-9]{10}$/;
			return re.test(phone);
		}
	</script>
</head>
<body>
	<h1>Registration Form</h1>
	<form name="registrationForm" class="fitdiv" method="post" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="email">Email:</label>
		<input type="email" name="email"><br>

		<label for="firstName">First Name:</label>
		<input type="text" name="firstName"><br>

		<label for="lastName">Last Name:</label>
		<input type="text" name="lastName"><br>

		<label for="phone">Phone Number:</label>
		<input type="tel" name="phone"><br>

        <label for="add">Address:</label>
		<input type="text" name="add"><br>

		<input type="submit" value="Submit">
	</form>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Get form data
			$email = $_POST["email"];
			$firstName = $_POST["firstName"];
			$lastName = $_POST["lastName"];
			$phone = $_POST["phone"];
            $address = $_POST["add"];

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

			// Check if email is already registered
			$sql = "SELECT * FROM customers WHERE email='$email'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "<script>alert('This email is already registered.')</script>";
			} else {
				// Insert new customer
				$sql = "INSERT INTO customers (email, first, last, phone, address) VALUES ('$email', '$firstName', '$lastName', '$phone', '$address')";

				if ($conn->query($sql) === TRUE) {
					echo "<script>alert('Registration successful.')</script>";
                    header("Location: index.html");
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}

			$conn->close();
		}
	?>
</body>
</html>