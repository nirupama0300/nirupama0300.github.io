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
            text - align : center;
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
        echo "connection succesful";
        // Prepare and bind SQL statement to insert data into the table
        $stmt = $conn->prepare("INSERT INTO bidders2(bidder_name, batting_avg, bowling_avg, total_runs, total_overs, total_wickets,economy, targets) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $bidderName = $_POST["bidderName"];
        $battingAvg = $_POST["batting_avg"];
        $bowlingAvg = $_POST["bowling_avg"];
        $totalRuns = $_POST["total_runs"];
        $totalOvers = $_POST["total_overs"];
        $totalWickets = $_POST["total_wickets"];
        $economy = $_POST["economy"];
        $targets = (2/7 * $battingAvg + 1/7 * $bowlingAvg + 2/7 * $totalRuns - 1/7 * $totalOvers + 1/7 * $totalWickets - 2/7 * $economy);

        // Bind parameters
        $stmt->bind_param("sddddddd", $bidderName, $battingAvg, $bowlingAvg, $totalRuns, $totalOvers, $totalWickets, $economy, $targets);
        if ($stmt === false) {
            die("Error preparing SQL statement: " . $conn->error);
        }


            // Calculate the target score for each bidder

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
