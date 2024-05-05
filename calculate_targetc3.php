<!DOCTYPE html>
<html>
<head>
    <title>Target Scores</title>
    <style>
        /* CSS styles for presentation */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .target-score {
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>Target Scores</h1>
    <div class="target-scores">
        <?php
        // Establish connection to MySQL database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ipl";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind SQL statement to insert data into the table
        $stmt = $conn->prepare("INSERT INTO bidders3(bidder_name, batting_avg, bowling_avg, strike_rate, economy, targets) VALUES (?, ?, ?, ?, ?, ?)");
        $bidderName = $_POST["bidderName"];
        $battingAvg = $_POST["batting_avg"];
        $bowlingAvg = $_POST["bowling_avg"];
        $strikeRate = $_POST["strike_rate"];
        $economy = $_POST["economy"];
        // Calculate the target score for each bidder
        $targets = 100 + (10/2)*(($battingAvg/50)+($strikeRate/150)) - (3/5)*(($bowlingAvg/40)+($economy/10));
        // Bind parameters
        $stmt->bind_param("sddddd", $bidderName, $battingAvg, $bowlingAvg, $strikeRate, $economy, $targets);
        if ($stmt === false) {
            die("Error preparing SQL statement: " . $conn->error);
        }



            // Execute SQL statement
            $stmt->execute();

            // Display the target score for each bidder
            echo "<div class='target-score'>$bidderName's Target Score: " . number_format($targets, 2) . "</div>";

        echo "Data inserted successfully";

        // Close statement and database connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
