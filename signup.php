<?php
// signup.php

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost"; // Database server name
$username = "root";          // Database username
$password = "";              // Database password
$dbname = "test";            // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$errorMessageUsername = "";
$errorMessageEmail = "";
$errorMessagePassword = "";
$name = "";
$email = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if the username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Loop through results to set appropriate error messages
        while ($row = $result->fetch_assoc()) {
            if ($row['Username'] === $name) {
                $errorMessageUsername = "Username already taken!";
            }
            if ($row['Email'] === $email) {
                $errorMessageEmail = "Email already registered!";
            }
        }
    } elseif ($password !== $confirmPassword) {
        // Check if the password and confirm password match
        $errorMessagePassword = "Passwords do not match!";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind for insertion
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the login page on successful signup
            header("Location: dashboard.php");
            exit(); // Ensure that no further code is executed after the redirect
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Include the HTML form, passing the error messages and user input values
include 'signup.html';
?>
