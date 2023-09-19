<?php
$servername = "localhost";
$username = "developer12345";
$password = "7dJM,^#ki@3r";
$dbname = "hashstream";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `settings` (`key`, `value`) VALUES 
('verification_page_1', ''),
('verification_page_2', ''),
('verification_page_3', ''),
('register_page_3', '');";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
