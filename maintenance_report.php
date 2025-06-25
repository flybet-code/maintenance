<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Maintenance Report</title>
</head>
<body>
    <h1>Submit Maintenance Report</h1>
    <form action="store_maintenance_report.php" method="POST">
        <label for="employee_name">Employee Name:</label>
        <input type="text" name="employee_name" required><br><br>

        <label for="room">Room:</label>
        <input type="text" name="room" required><br><br>

        <label for="research_type">Research Type:</label>
        <select name="research_type" required>
            <option value="Computer">Computer</option>
            <option value="Printer">Printer</option>
            <option value="Photocopy">Photocopy</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label for="issue_description">Issue Description:</label>
        <textarea name="issue_description" required></textarea><br><br>

        <button type="submit">Submit Maintenance Report</button>
    </form>
</body>
</html>
