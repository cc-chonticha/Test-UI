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

$id = $_POST['id'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$gender = $_POST['gender'];
$score = $_POST['score'];

$sql = "UPDATE user SET first_name='$firstName', last_name='$lastName', gender='$gender', score='$score' WHERE id=$id";

if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>



</body>
</html>