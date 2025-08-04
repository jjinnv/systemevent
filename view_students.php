<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.php?error=" . urlencode("Access denied"));
  exit();
}

include 'includes/db.php'; // Adjust if needed

// Fetch student records
$result = $conn->query("SELECT id, username, email, registered_at FROM students ORDER BY registered_at DESC");
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>View Students</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-6">

  <div class="max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">👩‍🎓 Registered Students</h1>

    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-md">
      <table class="min-w-full table-auto text-sm">
        <thead>
          <tr class="bg-gray-700 text-left text-gray-200 uppercase text-xs">
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Username</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Registered At</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b border-gray-700 hover:bg-gray-700">
              <td class="px-4 py-3"><?php echo $row['id']; ?></td>
              <td class="px-4 py-3"><?php echo htmlspecialchars($row['username']); ?></td>
              <td class="px-4 py-3"><?php echo htmlspecialchars($row['email']); ?></td>
              <td class="px-4 py-3"><?php echo $row['registered_at']; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      <a href="admin_panel.php" class="text-blue-400 hover:underline">&larr; Back to Panel</a>
    </div>
  </div>

</body>
</html>
