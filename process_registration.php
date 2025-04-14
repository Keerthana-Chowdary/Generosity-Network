<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Change based on your database credentials
$dbname = "charity";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $date_of_birth = htmlspecialchars($_POST['date_of_birth']);
    //$gender = htmlspecialchars($_POST['gender']);
    $ename = htmlspecialchars($_POST['eventName']);
    $eloc = htmlspecialchars($_POST['eventLocation']);

    // Insert data into the `users` table
    $sql = "INSERT INTO volunteers (first_name, last_name, email, phone_number, date_of_birth, event_name, event_location)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone_number, $date_of_birth, $ename, $eloc);

    if ($stmt->execute()) {
        echo "<script>
        alert('Volunteer registration done successfully.');
            window.location.href = 'events.php'; // Redirect after animation
    </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>