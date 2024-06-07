<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	
</head>
<body>
<?php
$mysqli = new mysqli("localhost", "root", "", "sample-data");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$gender = $_POST['gender'];
$score = $_POST['score'];

$sql = "INSERT INTO user (first_name, last_name, gender, score) VALUES ('$firstName', '$lastName', '$gender', '$score')";

if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>





</body>
</html>