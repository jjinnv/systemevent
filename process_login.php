<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
      $_SESSION['admin'] = $user['username'];
      header("Location: login.php?success=1");
      exit();

    } else {
      echo "<script>alert('Invalid password.'); window.location.href='login.php';</script>";
    }
  } else {
    echo "<script>alert('Invalid username.'); window.location.href='login.php';</script>";
  }

  $stmt->close();
  $conn->close();
}
?>