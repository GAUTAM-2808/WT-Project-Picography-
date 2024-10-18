<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Database connection parameters
$servername = "localhost";
$dbUsername = "root"; 
$dbPassword = ""; 
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an error message variable
$errorMessage = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if username and password are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($pass, $row['Password'])) {
                // User exists and password is correct
                $_SESSION['username'] = $user;
                header("Location: dashboard.php");
                exit();
            } else {
                $errorMessage = "Invalid username or password.";
            }
        } else {
            $errorMessage = "Invalid username or password.";
        }
    } else {
        $errorMessage = "Please enter both username and password."; // Set the error message
    }
}

// Close the connection
$conn->close();

// Include the HTML form, passing the error message and user input values
include 'login.html'; // Assuming your HTML is in login.html
?>
