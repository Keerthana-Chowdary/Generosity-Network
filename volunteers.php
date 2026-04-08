<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Change based on your credentials
$dbname = "charity";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the volunteers table
$sql = "SELECT id, first_name, last_name, email, phone_number, date_of_birth, event_name, event_location FROM volunteers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Falling stars animation */
        body {
            background: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 80px;
            background: linear-gradient(0deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            animation: fall 3s linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100vh) translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) translateX(50px);
                opacity: 0;
            }
        }

        .container {
            margin-top: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Table styling */
        .volunteers-table {
            color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.3);
        }

        .table-header {
            background-color: black;
            color: white;
            text-align: center;
        }

        .table-row td {
            color: white;
        }

        .table-row:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Human shapes and animation */
        .animation-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .human {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 100px;
            background: white;
            margin: 0 15px;
            border-radius: 8px;
            animation: moveSideways 3s infinite alternate ease-in-out;
        }

        .human-head {
            position: absolute;
            top: -18px;
            left: 15px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
        }

        .human-arms {
            position: absolute;
            top: 35px;
            width: 8px;
            height: 40px;
            background: white;
            border-radius: 5px;
        }

        .human-arm-left {
            left: -10px;
            transform-origin: top;
            animation: waveLeft 2s infinite alternate;
        }

        .human-arm-right {
            right: -10px;
            transform-origin: top;
            animation: waveRight 2s infinite alternate;
        }

        .human-legs {
            position: absolute;
            top: 80px;
            width: 8px;
            height: 30px;
            background: white;
            border-radius: 5px;
        }

        .human-leg-left {
            left: 12px;
        }

        .human-leg-right {
            right: 12px;
        }

        @keyframes moveSideways {
            0% {
                transform: translateX(-20px);
            }
            100% {
                transform: translateX(20px);
            }
        }

        @keyframes waveLeft {
            0% {
                transform: rotate(-10deg);
            }
            100% {
                transform: rotate(10deg);
            }
        }

        @keyframes waveRight {
            0% {
                transform: rotate(10deg);
            }
            100% {
                transform: rotate(-10deg);
            }
        }

        /* Go Back Button */
        .go-back {
            text-align: center;
            margin-top: 20px;
        }

        .go-back a {
            text-decoration: none;
            color: black;
            background: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.3);
            transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease;
        }

        .go-back a:hover {
            background: gray;
            color: white;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <h1>Registered Volunteers</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="table volunteers-table">
                <thead class="table-header">
                    <tr>
                        <th>S_No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Date of Birth</th>
                        <th>City</th>
                        <th>District</th>
                        <th>Event Name</th>
                        <th>Event Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="table-row">
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_location']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No volunteers found.</p>
        <?php endif; ?>

        <!-- Humans moving aside and then to their positions -->
        <div class="animation-container">
            <div class="human">
                <div class="human-head"></div>
                <div class="human-arms human-arm-left"></div>
                <div class="human-arms human-arm-right"></div>
                <div class="human-legs human-leg-left"></div>
                <div class="human-legs human-leg-right"></div>
            </div>
            <div class="human">
                <div class="human-head"></div>
                <div class="human-arms human-arm-left"></div>
                <div class="human-arms human-arm-right"></div>
                <div class="human-legs human-leg-left"></div>
                <div class="human-legs human-leg-right"></div>
            </div>
            <div class="human">
                <div class="human-head"></div>
                <div class="human-arms human-arm-left"></div>
                <div class="human-arms human-arm-right"></div>
                <div class="human-legs human-leg-left"></div>
                <div class="human-legs human-leg-right"></div>
            </div>
            <div class="human">
                <div class="human-head"></div>
                <div class="human-arms human-arm-left"></div>
                <div class="human-arms human-arm-right"></div>
                <div class="human-legs human-leg-left"></div>
                <div class="human-legs human-leg-right"></div>
            </div>
        </div>

        <!-- Go Back Button -->
        <div class="go-back">
            <a href="admin_dashboard.php">Go Back</a>
        </div>
    </div>

    <script>
        // Falling Stars Logic
        const background = document.querySelector('.background');

        function