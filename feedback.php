<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Change as per your credentials
$dbname = "charity";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT s_no, name, email, message FROM contacters";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Falling stars animation background */
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
                transform: translateY(-100vh);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }

        .container {
            margin-top: 50px;
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
        .feedback-table {
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

        /* Volunteer animation */
        .animation-container {
            display: flex;
            justify-content: space-evenly;
            margin-top: 20px;
        }

        .human {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 80px;
            background: white;
            border-radius: 8px;
            animation: moveBackForth 3s infinite alternate ease-in-out;
        }

        .human-head {
            position: absolute;
            top: -15px;
            left: 10px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
        }

        .human-hello {
            position: absolute;
            top: -30px;
            left: -10px;
            width: 50px;
            background: black;
            color: white;
            border-radius: 10px;
            font-size: 10px;
            padding: 3px;
            text-align: center;
            animation: popUp 1.5s infinite alternate;
        }

        @keyframes popUp {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .human-arm {
            position: absolute;
            width: 6px;
            height: 25px;
            background: white;
            top: 25px;
            border-radius: 5px;
        }

        .human-arm-left {
            left: -8px;
        }

        .human-arm-right {
            right: -8px;
            transform-origin: top right;
            animation: waving 1.5s infinite alternate ease-in-out;
        }

        @keyframes waving {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(20deg);
            }
        }

        .human-leg {
            position: absolute;
            width: 6px;
            height: 30px;
            background: white;
            top: 50px;
            border-radius: 5px;
        }

        .human-leg-left {
            left: 8px;
        }

        .human-leg-right {
            right: 8px;
        }

        @keyframes moveBackForth {
            0% {
                transform: translateX(-20px);
            }
            100% {
                transform: translateX(20px);
            }
        }

        /* Go Back Button */
        .go-home {
            text-align: center;
            margin-top: 20px;
        }

        .go-home a {
            text-decoration: none;
            color: black;
            background: white;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.3);
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .go-home a:hover {
            background: gray;
            color: white;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <h1>Feedbacks</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="table feedback-table">
                <thead class="table-header">
                    <tr>
                        <th>S_No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="table-row">
                            <td><?php echo htmlspecialchars($row['s_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-feedback">No feedbacks found.</p>
        <?php endif; ?>

        <!-- Volunteers greeting -->
        <div class="animation-container">
            <div class="human">
                <div class="human-head"></div>
                <div class="human-hello">Hi!</div>
                <div class="human-arm human-arm-left"></div>
                <div class="human-arm human-arm-right"></div>
                <div class="human-leg human-leg-left"></div>
                <div class="human-leg human-leg-right"></div>
            </div>
            <div class="human">
                <div class="human-head"></div>
                <div class="human-hello">Hello!</div>
                <div class="human-arm human-arm-left"></div>
                <div class="human-arm human-arm-right"></div>
                <div class="human-leg human-leg-left"></div>
                <div class="human-leg human-leg-right"></div>
            </div>
            <div class="human">
                <div class="human-head"></div>
                <div class="human-hello">Hi!</div>
                <div class="human-arm human-arm-left"></div>
                <div class="human-arm human-arm-right"></div>
                <div class="human-leg human-leg-left"></div>
                <div class="human-leg human-leg-right"></div>
            </div>
            <div class="human">
                <div class="human-head"></div>
                <div class="human-hello">Hello!</div>
                <div class="human-arm human-arm-left"></div>
                <div class="human-arm human-arm-right"></div>
                <div class="human-leg human-leg-left"></div>
                <div class="human-leg human-leg-right"></div>
            </div>
        </div>

        <!-- Go Back Button -->
        <div class="go-home">
            <a href="admin_dashboard.php">Go Back</a>
        </div>
    </div>

    <script>
        // Falling Stars Logic
        const background = document.querySelector('.background');

        function createStar() {
            const star = document.createElement('div');
            star.classList.add('star');
            star.style