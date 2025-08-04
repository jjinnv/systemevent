<?php
session_start();
include 'includes/db.php'; // Adjust if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Get user from DB
  $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();

    // Check if the account is an admin
    if ($admin['role'] !== 'admin') {
      header("Location: admin_login.php?error=" . urlencode("Not an admin account"));
      exit();
    }

    // Verify password
    if (password_verify($password, $admin['password'])) {
      $_SESSION['admin'] = $admin['username'];
      header("Location: admin_panel.php");
      exit();
    } else {
      header("Location: admin_login.php?error=" . urlencode("Invalid password"));
      exit();
    }
  } else {
    header("Location: admin_login.php?error=" . urlencode("Admin not found"));
    exit();
  }
}
?>
