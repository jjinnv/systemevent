<?php
include 'includes/db.php'; // adjust if needed

$query = "SELECT * FROM registered_events ORDER BY registered_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Upcoming Events</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="upcoming_event.css" />
  <script src="upcoming_event.js" defer></script>

  <style>

    /* Navbar Glass */
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(8px);
      z-index: 999;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }

    .nav-brand {
      font-size: 1.5rem;
      color: #00bfff;
      font-weight: bold;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 40px;
      margin: 0;
      padding: 0;
    }

    .nav-links li a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    .nav-links li a:hover {
      color: #00bfff;
    }

    main {
      padding: 120px 20px 40px;
      max-width: 800px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
      font-size: 2.2rem;
      color: #00bfff;
      margin-bottom: 30px;
      text-align: center;
    }

    .event-section {
  padding-top: 100px; /* Adjust depending on navbar height */
}

    @keyframes slideInTopSection {
  from {
    opacity: 0;
    transform: translateY(-50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

    .event-section {
  animation: slideInTopSection 0.8s ease-out forwards;
  opacity: 0; /* Start hidden */
}



    .event-card {
  width: 80%;
  max-width: 600px; /* Limits width to 600px */
  margin: 15px auto; /* Center and space vertically */
  background: #1e2a3a;
  border-left: 4px solid #00bfff;
  padding: 16px; /* Reduced padding */
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.3);
  opacity: 0;
  animation: fadeInUp 0.6s ease forwards;
  transition: transform 0.2s;
}

.event-card:hover {
  transform: translateY(-5px);
}

.event-card h3 {
  font-size: 1.1rem; /* Slightly smaller title */
  color: #00bfff;
  margin: 0 0 8px;
}

.event-card p {
  margin: 4px 0;
  font-size: 0.95rem;
  color: #d3d3d3;
}

.event-card p b {
  color: white;
}


    /* Staggered animation delay */
    .event-card:nth-child(2) { animation-delay: 0.2s; }
    .event-card:nth-child(3) { animation-delay: 0.4s; }
    .event-card:nth-child(4) { animation-delay: 0.6s; }

    @keyframes fadeInUp {
      from {
        transform: translateY(20px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .glass-footer {
      text-align: center;
      padding: 30px;
      background: rgba(0, 0, 30, 0.8);
      color: #aaa;
      font-size: 0.95rem;
      margin-top: 50px;
    }

    .glass-footer a {
      color: #00bfff;
      text-decoration: none;
    }

    .glass-footer a:hover {
      text-decoration: underline;
    }

    .social-icons {
      margin: 10px 0;
    }

    .social-icons a {
      margin: 0 8px;
      color: #00bfff;
      font-size: 1.2rem;
    }

    .social-icons a:hover {
      color: white;
    }

    .fade-delay {
  opacity: 0;
  animation: fadeInUp 0.6s ease forwards;
  animation-delay: 0.2s;
}

  </style>
</head>

<body>

  <!-- ✅ NAVIGATION (moved to body) -->
  <nav class="navbar glass">
    <a href="index.html" class="nav-brand">🎓 <span>School Events</span></a>
    <ul class="nav-links">
      <li><a href="index.html">Home</a></li>
      <li><a href="register_event.html">Register</a></li>
      <li><a href="upcoming_event.php">Events</a></li>
    </ul>
  </nav>
  
  <div class="event-section">
  <h2>📋 Upcoming Events</h2>

  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="event-card">
        <h3>🎓 <?php echo htmlspecialchars($row['student_name']); ?></h3>
        <p><b>Student ID:</b> <?php echo htmlspecialchars($row['student_id']); ?></p>
        <p><b>Number of People:</b> <?php echo $row['number_of_people']; ?></p>
        <p><b>Event:</b> <?php echo htmlspecialchars($row['event_name']); ?></p>
        <p><b>Location:</b> <?php echo htmlspecialchars($row['location']); ?></p>
        <p><b>Registered At:</b> <?php echo $row['registered_at']; ?></p>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <tr>
  <td colspan="7" class="py-10">
    <div style="display: flex; justify-content: center;">
      <div style="
        background-color: #1f2937;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.4);
        text-align: center;
        width: 100%;
        max-width: 400px;
        color: #d1d5db;
        margin: 0 auto;
      ">
        <p style="font-size: 1.1rem;">📭 No event registrations found.</p>
      </div>
    </div>
  </td>
</tr>

  <?php endif; ?>
</div>

  <!-- Footer -->
  <footer class="glass-footer">
    <p>📩 Contact us: <a href="mailto:eventadmin@school.edu.my">smjkphortay@school.edu.my</a></p>
    <div class="social-icons">
      <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
      <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    </div>
    <p>🌟 Created with love by Team ET </p>
  </footer>

</body>
</html>
