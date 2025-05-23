<?php 
include("database.php"); // Include database connection

// Fetch feedback from the database
$sql = "SELECT  fullname, email, opinion FROM feedback ";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Feedbacks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #e7bc91;
        }
        h2 {
            text-align: center;
            color: #583101;
        }
        .feedback-table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .feedback-table th, .feedback-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .feedback-table th {
            background-color: #b07d62;
            color: white;
        }
        .feedback-table tr:hover {
            background-color: #f1f1f1;
        }
        .no-feedback {
            text-align: center;
            font-size: 18px;
            color: #777;
        }
    </style>
</head>
<body>
    <!-- navbar -->
 


<!-- sidebar -->
<?php include("sidebar_admin.php"); ?>
    <h2>Admin - User Feedback</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="feedback-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Opinion</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['opinion'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-feedback">No feedback found.</p>
    <?php endif; ?>

</body>
</html>
