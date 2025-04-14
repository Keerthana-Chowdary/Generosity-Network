<?php
$conn = new mysqli("localhost", "root", "", "charity");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, password FROM admin_details");

while ($row = $result->fetch_assoc()) {
    $hashedPassword = password_hash($row['password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE admin_details SET password = '$hashedPassword' WHERE id = {$row['id']}");
    echo "<script>alert('Password Hashed Successfully');</script>";
}

$conn->close();
?>