<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.php?error=" . urlencode("Access denied"));
  exit();
}

include 'includes/db.php';

$query = "SELECT * FROM registered_events ORDER BY registered_at DESC";
$result = $conn->query($query);
echo "<pre>Total rows: " . $result->num_rows . "</pre>";

if (!$result) {
  die("SQL error: " . $conn->error);
} else {
  echo "<!-- Rows: " . $result->num_rows . " -->";
}

?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>Registered Events</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-6">

  <div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">📅 Registered Events</h1>

    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-md">
      <table class="min-w-full table-auto text-sm">
        <thead>
          <tr class="bg-gray-700 text-left text-gray-200 uppercase text-xs">
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Student Name</th>
            <th class="px-4 py-3">Student ID</th>
            <th class="px-4 py-3">People</th>
            <th class="px-4 py-3">Event</th>
            <th class="px-4 py-3">Location</th>
            <th class="px-4 py-3">Registered At</th>
          </tr>
        </thead>
        <tbody>
  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr class="border-b border-gray-700 hover:bg-gray-700">
        <td class="px-4 py-3"><?php echo $row['id']; ?></td>
        <td class="px-4 py-3"><?php echo htmlspecialchars($row['student_name']); ?></td>
        <td class="px-4 py-3"><?php echo htmlspecialchars($row['student_id']); ?></td>
        <td class="px-4 py-3"><?php echo $row['number_of_people']; ?></td>
        <td class="px-4 py-3"><?php echo htmlspecialchars($row['event_name']); ?></td>
        <td class="px-4 py-3"><?php echo htmlspecialchars($row['location']); ?></td>
        <td class="px-4 py-3"><?php echo $row['registered_at']; ?></td>
      </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr>
      <td colspan="7" class="px-4 py-4 text-center text-gray-400">No registrations found.</td>
    </tr>
  <?php endif; ?>
</tbody> 
      </table>
    </div>

    <div class="mt-6">
      <a href="admin_panel.php" class="text-blue-400 hover:underline">&larr; Back to Panel</a>
    </div>
  </div>

</body>
</html>
