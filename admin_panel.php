<?php
session_start();

// Protect the admin panel
if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.php?error=" . urlencode("Please log in as admin"));
  exit();
}

$adminName = htmlspecialchars($_SESSION['admin']);
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: linear-gradient(270deg, #1f2937, #111827, #1f2937);
      background-size: 600% 600%;
      animation: gradientMove 20s ease infinite;
      z-index: -1;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .glass {
      backdrop-filter: blur(16px);
      background-color: rgba(31, 41, 55, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .fade-in {
      animation: fadeIn 0.7s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body class="text-white min-h-screen flex items-center justify-center px-4">
  <div class="glass rounded-lg p-8 w-full max-w-2xl fade-in text-center shadow-2xl">
    <h1 class="text-3xl font-bold mb-2">Welcome, Admin 🎉</h1>
    <p class="mb-6 text-gray-300">Logged in as: <strong><?php echo $adminName; ?></strong></p>

    <div class="grid grid-cols-2 gap-4 mb-6">
      <a href="view_students.php" class="bg-blue-600 hover:bg-blue-700 py-3 rounded-lg shadow-md transition">Manage Group</a>
      <a href="view_registered_events.php" class="bg-green-600 hover:bg-green-700 py-3 rounded-lg shadow-md transition">Manage Events</a>
    </div>

    <a href="logout.php" class="text-sm text-red-400 hover:underline">Logout</a>
  </div>
</body>
</html>
