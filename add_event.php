<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $cardno = $_POST['cardno'];
    $cardname = $_POST['cardname'];
    $cvv = $_POST['cvv'];
    $mobile = $_POST['mobile'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'charity');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data
    $sql = "INSERT INTO events (event_name, event_date, event_location, event_duration, address, city, state, country, card_number, card_holder_name, cvv, mobile_number) 
            VALUES ('$eventName', '$eventDate', '$location', '$duration', '$address', '$city', '$state', '$country', '$cardno', '$cardname', '$cvv', '$mobile')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Event added successfully.');
            window.location.href = 'admin_dashboard.php'; // Redirect after animation
    </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>