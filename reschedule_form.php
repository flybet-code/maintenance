<?php
// Reschedule form code (reschedule_form.php)
if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];
    // Fetch existing request details (if needed)
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Maintenance Request</title>
</head>
<body>
    <h2>Reschedule Maintenance Request</h2>
    <form method="POST" action="staff_dashboard.php">
        <input type="hidden" name="request_id" value="<?php echo $request_id; ?>" required>
        <label for="new_schedule">New Schedule:</label>
        <input type="datetime-local" name="new_schedule" required>
        <button type="submit" name="reschedule">Submit Reschedule</button>
    </form>
</body>
</html>
