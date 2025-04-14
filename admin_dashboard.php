<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General Body Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: black;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Falling Stars Background */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 80px;
            background: linear-gradient(0deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            animation: fall 3s linear infinite;
        }

        @keyframes fall {
            from {
                transform: translateY(-100vh) translateX(0);
                opacity: 1;
            }
            to {
                transform: translateY(100vh) translateX(50px);
                opacity: 0;
            }
        }

        /* Dashboard Content */
        .dashboard {
            text-align: center;
            width: 90%;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 0px 4px 8px rgba(255, 255, 255, 0.5);
        }

        /* Card Design with Unique Colors */
        .card {
            background: #222222;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 12px;
            margin: 20px auto;
            padding: 20px;
            max-width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.3);
        }

        /* Unique Button Colors */
        .btn {
            display: inline-block;
            text-decoration: none;
            background: #00cec9;
            color: black;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background: #74b9ff;
            transform: scale(1.1);
        }

        /* Logout Button with Different Style */
        .logout .btn {
            background: #d63031;
            color: white;
        }

        .logout .btn:hover {
            background: #ff7675;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="dashboard">
        <h1>Welcome Admin!</h1>
        <div class="card">
            <h2>Add Events</h2>
            <p>Manage and create new charity events.</p>
            <a href="add_event.html" class="btn">Add Event</a>
        </div>
        <div class="card">
            <h2>Volunteers Registered</h2>
            <p>View and manage volunteer registrations.</p>
            <a href="volunteers.php" class="btn">View Volunteers</a>
        </div>
        <div class="card">
            <h2>Feedback</h2>
            <p>Collect and review feedback from participants.</p>
            <a href="feedback.php" class="btn">View Feedback</a>
        </div>
        <div class="logout">
            <a href="home.html" class="btn">Logout</a>
        </div>
    </div>

    <script>
        // Create Falling Stars
        const background = document.querySelector('.background');

        function createStar() {
            const star = document.createElement('div');
            star.classList.add('star');
            star.style.left = `${Math.random() * 100}vw`;
            star.style.animationDuration = `${Math.random() * 2 + 1}s`; // Randomize speed
            background.appendChild(star);

            setTimeout(() => {
                star.remove();
            }, 3000);
        }

        setInterval(createStar, 100);
    </script>
</body>
</html>