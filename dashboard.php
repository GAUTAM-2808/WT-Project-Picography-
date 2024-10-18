<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- Inbuilt CSS -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
      position: relative;
    }

    h1 {
      font-size: 2.5rem;
    }

    /* Logout Button Styling */
    .logout-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #c82333;
    }

    .dashboard-options {
      padding: 50px;
      text-align: center;
      flex-grow: 1;
    }

    .dashboard-options h2 {
      font-size: 2rem;
      margin-bottom: 40px;
      color: #333;
    }

    .dashboard-options ul {
      list-style: none;
      padding: 0;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .dashboard-options ul li {
      margin: 15px 0;
    }

    .dashboard-options ul li a {
      display: inline-block;
      text-decoration: none;
      background-color: #007bff;
      color: #fff;
      padding: 15px 30px;
      font-size: 1.2rem;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .dashboard-options ul li a:hover {
      background-color: #0056b3;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
      position: relative;
      bottom: 0;
      width: 100%;
    }
  </style>

</head>
<body>
  <header>
    <h1>Welcome to your Dashboard, <?php echo htmlspecialchars($username); ?></h1>

    <!-- Logout Button -->
    <form action="logout.php" method="POST" style="display:inline;">
      <button class="logout-btn" type="submit">Logout</button>
    </form>
  </header>

  <section class="dashboard-options">
    <h2>Navigate:</h2>
    <ul>
      <li><a href="gallery.html">Gallery</a></li>
      <li><a href="store.html">Store</a></li>
      <li><a href="Feedback.html">Feedback</a></li>
    </ul>
  </section>

  <footer>
    <p>&copy; 2024 PictoGraphy.com. All rights reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>