<?php
// Database connection parameters
$servername = "localhost"; // Your MySQL server (usually localhost)
$username = "root";         // MySQL username (default for XAMPP is 'root')
$password = "";             // MySQL password (default for XAMPP is empty)
$dbname = "test";           // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to insert two users
$sql1 = "INSERT INTO users (username, password) VALUES ('user1', 'password1')";
$sql2 = "INSERT INTO users (username, password) VALUES ('user2', 'password2')";

// Execute the queries
if ($conn->query($sql1) === TRUE) {
    echo "New user user1 created successfully<br>";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
    echo "New user user2 created successfully<br>";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
