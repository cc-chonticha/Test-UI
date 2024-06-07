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

$result = $mysqli->query("SELECT * FROM user");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $genderInitial = strtoupper(substr($row['gender'], 0, 1)); // แสดงเฉพาะตัวอักษรแรกของ gender
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td class='first_name'>" . $row['first_name'] . "</td>";
        echo "<td class='last_name'>" . $row['last_name'] . "</td>";
        echo "<td class='gender'>" . $genderInitial . "</td>"; // ใช้ตัวแปร genderInitial แทน
        echo "<td class='score'>" . $row['score'] . "</td>";
        echo "<td><button class='edit-btn' data-id='" . $row['id'] . "'>Edit</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

$mysqli->close();
?>



</body>
</html>