<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor_consultation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all submissions
$sql = "SELECT * FROM consultations ORDER BY submission_date DESC";
$result = $conn->query($sql);

// Export functionality
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="doctor_consultations_' . date('Y-m-d') . '.csv"');
    
    // Create output stream
    $output = fopen('php://output', 'w');
    
    // Add CSV headers
    fputcsv($output, ['ID', 'Doctor', 'Name', 'Phone', 'Email', 'Disease', 'Amount', 'Sex', 'Question', 'Submission Date']);
    
    // Add data rows
    while($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
    
    // Close output stream
    fclose($output);
    exit();
}

// Requery the data for display (since we might have consumed the result set for export)
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Consultation Submissions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .back-btn {
            display: inline-block;
            background-color: #009933;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 20px;
            margin-right: 10px;
        }
        .action-buttons {
            margin: 20px 0;
            text-align: right;
        }
        .print-btn {
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 10px;
        }
        .export-btn {
            background-color: #cc6600;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
        }
        @media print {
            .action-buttons, .back-btn {
                display: none;
            }
            body {
                background-color: white;
                padding: 0;
            }
            .container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
        }
        @media screen and (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Doctor Consultation Submissions</h1>
        
        <div class="action-buttons">
            <button onclick="window.print();" class="print-btn">Print</button>
            <a href="viewSubmissions.php?export=csv" class="export-btn">Export to CSV</a>
        </div>
        
        <?php
        if ($result->num_rows > 0) {
            echo '<table>
                <tr>
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Disease</th>
                    <th>Amount</th>
                    <th>Sex</th>
                    <th>Question</th>
                    <th>Submission Date</th>
                </tr>';
            
            while($row = $result->fetch_assoc()) {
                echo '<tr>
                    <td>' . $row["id"] . '</td>
                    <td>' . htmlspecialchars($row["doctor"]) . '</td>
                    <td>' . htmlspecialchars($row["name"]) . '</td>
                    <td>' . htmlspecialchars($row["phone"]) . '</td>
                    <td>' . htmlspecialchars($row["email"]) . '</td>
                    <td>' . htmlspecialchars($row["disease"]) . '</td>
                    <td>' . htmlspecialchars($row["amount"]) . '</td>
                    <td>' . htmlspecialchars($row["sex"]) . '</td>
                    <td>' . htmlspecialchars($row["question"]) . '</td>
                    <td>' . $row["submission_date"] . '</td>
                </tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No submissions found.</p>';
        }
        $conn->close();
        ?>
        
        <a href="index.php" class="back-btn">Back to Form</a>
    </div>
</body>
</html>