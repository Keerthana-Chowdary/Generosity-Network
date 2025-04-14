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

// Fetch data from the events table
$sql = "SELECT id, event_name, event_location, event_date, event_duration, address, city, state, country FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Full-page animated particles background */
        body {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            overflow: auto; /* Enable scrolling */
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensure it's behind the content */
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
            animation: zoomInOut 3s infinite; /* Zoom in/out effect */
        }

        @keyframes zoomInOut {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .event-card {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            text-align: center; /* Align content to the center */
            color: #fff;
            margin-bottom: 30px;
        }

        .event-card h5 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #ffd700;
        }

        .register-btn {
            margin-top: 15px;
        }

        .register-btn a {
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .register-btn a:hover {
            background-color: #218838;
        }

        .go-home {
            text-align: center;
            margin-top: 20px;
        }

        .go-home a {
            text-decoration: none;
            color: #ffffff;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .go-home a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <canvas></canvas> <!-- Particle animation canvas -->
    <div class="container">
        <h1>Upcoming Events</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="event-card">
                    <h5><?php echo htmlspecialchars($row['event_name']); ?></h5>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['event_location']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($row['event_date']); ?></p>
                    <p><strong>Duration:</strong> <?php echo htmlspecialchars($row['event_duration']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                    <p><strong>City:</strong> <?php echo htmlspecialchars($row['city']); ?></p>
                    <p><strong>State:</strong> <?php echo htmlspecialchars($row['state']); ?></p>
                    <p><strong>Country:</strong> <?php echo htmlspecialchars($row['country']); ?></p>
                    <div class="register-btn">
                        <a href="register_volunteer.html?event_id=<?php echo htmlspecialchars($row['id']); ?>">Register as a Volunteer</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No events found.</p>
        <?php endif; ?>

        <!-- Go Home Button -->
        <div class="go-home">
            <a href="home.html">Go Home</a>
        </div>
    </div>

    <script>
        // Particle animation script
        const canvas = document.querySelector("canvas");
        const ctx = canvas.getContext("2d");

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particlesArray = [];
        const numberOfParticles = 100;

        class Particle {
            constructor(x, y, size, color, velocityX, velocityY) {
                this.x = x;
                this.y = y;
                this.size = size;
                this.color = color;
                this.velocityX = velocityX;
                this.velocityY = velocityY;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = this.color;
                ctx.fill();
            }

            update() {
                this.x += this.velocityX;
                this.y += this.velocityY;

                // Bounce off edges
                if (this.x + this.size > canvas.width || this.x - this.size < 0) {
                    this.velocityX *= -1;
                }
                if (this.y + this.size > canvas.height || this.y - this.size < 0) {
                    this.velocityY *= -1;
                }
            }
        }

        function init() {
            for (let i = 0; i < numberOfParticles; i++) {
                const size = Math.random() * 5 + 1;
                const x = Math.random() * (canvas.width - size * 2) + size;
                const y = Math.random() * (canvas.height - size * 2) + size;
                const color = "rgba(255, 255, 255, 0.8)";
                const velocityX = Math.random() * 2 - 1;
                const velocityY = Math.random() * 2 - 1;

                particlesArray.push(new Particle(x, y, size, color, velocityX, velocityY));
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particlesArray.forEach((particle) => {
                particle.update();
                particle.draw();
            });

            requestAnimationFrame(animate);
        }

        init();
        animate();
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>