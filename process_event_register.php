<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $studentName = $_POST['studentName'];
  $studentId = $_POST['studentId'];
  $numPeople = $_POST['numPeople'];
  $eventSelection = $_POST['eventSelection'] === "Other" ? $_POST['otherEvent'] : $_POST['eventSelection'];
  $eventLocation = $_POST['eventLocation'] === "Other" ? $_POST['otherPlace'] : $_POST['eventLocation'];

  $stmt = $conn->prepare("INSERT INTO registered_events (student_name, student_id, number_of_people, event_name, location) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssiss", $studentName, $studentId, $numPeople, $eventSelection, $eventLocation);

  if ($stmt->execute()) {
    header("Location: register_event.html?success=" . urlencode("Successfully registered!"));
    exit();
  } else {
    header("Location: register_event.html?error=" . urlencode("Failed to register."));
    exit();
  }
}
?>
