<?php
session_start(); // Start session for login tracking

// Database connection
$conn = new mysqli("localhost", "root", "", "charity");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']); // Captures entered email
    $password = trim($_POST['password']);         // Captures entered password

    // Prepare and execute SQL query to check admin details
    $stmt = $conn->prepare("SELECT id, password FROM admin_details WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify admin details
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true; // Set session variable
            $_SESSION['admin_id'] = $row['id']; // Store admin ID in session
            echo "Login successful!";
            header("Location: admin_dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            echo "<script>
            alert('Invalid password. Please try again.');
                window.location.href = 'admin_login.html'; // Redirect after animation
        </script>";
        }
    } else {
        echo "No user found with these credentials!";
    }
    $stmt->close();
}

$conn->close();
?>