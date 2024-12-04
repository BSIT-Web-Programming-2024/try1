<?php
// Database connection configuration
$host = "localhost"; // Change to your host if not localhost
$username = "root";  // Your MySQL username
$password = "";      // Your MySQL password
$dbname = "contact_system"; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendMessage'])) {
    // Capture form data
    $senderName = mysqli_real_escape_string($conn, $_POST['senderName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $senderEmail = mysqli_real_escape_string($conn, $_POST['senderEmail']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into database
    $sql = "INSERT INTO contacts (name, phone, email, message) 
            VALUES ('$senderName', '$phoneNumber', '$senderEmail', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>