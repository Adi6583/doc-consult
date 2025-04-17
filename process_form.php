<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor_consultation";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS consultations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    doctor VARCHAR(100) NOT NULL,
    name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    disease VARCHAR(100) NOT NULL,
    amount VARCHAR(50) NOT NULL,
    sex VARCHAR(10) NOT NULL,
    question TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Process form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $doctor = $conn->real_escape_string($_POST['doctor']);
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $disease = $conn->real_escape_string($_POST['disease']);
    $amount = $conn->real_escape_string($_POST['amount']);
    $sex = $conn->real_escape_string($_POST['sex']);
    $question = $conn->real_escape_string($_POST['question']);
    
    // Insert data into the database
    $sql = "INSERT INTO consultations (doctor, name, phone, email, disease, amount, sex, question)
            VALUES ('$doctor', '$name', '$phone', '$email', '$disease', '$amount', '$sex', '$question')";
    
    if ($conn->query($sql) === TRUE) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Submission Successful</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                    padding: 20px;
                    text-align: center;
                    background-image: linear-gradient(to top, #accbee 0%, #e7f0fd 100%);
                    background-attachment: fixed;
                }
                .success-container {
                    max-width: 700px;
                    margin: 50px auto;
                    background-color: white;
                    padding: 30px;
                    border-radius: 8px;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
                h1 {
                    color: #009933;
                    margin-bottom: 20px;
                }
                .back-btn {
                    display: inline-block;
                    background-color: #009933;
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top: 20px;
                    transition: all 0.3s ease;
                }
                .back-btn:hover {
                    background-color: #008028;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                }
                .patient-details {
                    text-align: left;
                    background-color: #f9f9f9;
                    padding: 20px;
                    border-radius: 5px;
                    margin-top: 20px;
                    border-left: 4px solid #009933;
                }
                .patient-details h3 {
                    color: #333;
                    margin-top: 0;
                }
                .detail-item {
                    margin-bottom: 10px;
                }
                .detail-label {
                    font-weight: bold;
                    color: #555;
                }
                .patient-question {
                    margin-top: 20px;
                    padding: 15px;
                    background-color: #f0f7ff;
                    border-radius: 5px;
                    border-left: 4px solid #0066cc;
                }
                .view-all {
                    display: inline-block;
                    background-color: #0066cc;
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top: 20px;
                    margin-left: 10px;
                    transition: all 0.3s ease;
                }
                .view-all:hover {
                    background-color: #0055aa;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                }
                @media (max-width: 768px) {
                    .success-container {
                        padding: 20px;
                        margin: 30px 15px;
                    }
                    .patient-details, .patient-question {
                        padding: 15px;
                    }
                }
            </style>
        </head>
        <body>
            <div class='success-container'>
                <h1>Thank You!</h1>
                <p>Your consultation request has been submitted successfully.</p>
                <p>A doctor will contact you soon.</p>
                
                <div class='patient-details'>
                    <h3>Submission Details</h3>
                    <div class='detail-item'><span class='detail-label'>Name:</span> " . htmlspecialchars($name) . "</div>
                    <div class='detail-item'><span class='detail-label'>Doctor:</span> " . htmlspecialchars($doctor) . "</div>
                    <div class='detail-item'><span class='detail-label'>Disease:</span> " . htmlspecialchars($disease) . "</div>
                    <div class='detail-item'><span class='detail-label'>Contact:</span> " . htmlspecialchars($phone) . " / " . htmlspecialchars($email) . "</div>
                    
                    <div class='patient-question'>
                        <span class='detail-label'>Patient's Question:</span>
                        <p>" . nl2br(htmlspecialchars($question)) . "</p>
                    </div>
                </div>
                
                <div style='margin-top: 25px;'>
                    <a href='index.php' class='back-btn'>Back to Form</a>
                    <a href='viewSubmissions.php' class='view-all'>View All Submissions</a>
                </div>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>