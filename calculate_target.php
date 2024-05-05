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
        $stmt = $conn->prepare("INSERT INTO bidders (bidder_name, total_runs, total_overs, total_wickets, target) VALUES (?, ?, ?, ?, ?)");
        $bidderName = $_POST["bidderName"];
        $totalRuns = $_POST["total_runs"];
        $totalOvers = $_POST["total_overs"];
        $totalWickets = $_POST["total_wickets"];
        
        // Bind parameters
        $stmt->bind_param("sdddd", $bidderName, $totalRuns, $totalOvers, $totalWickets, $target);

        // Loop through each bidder to insert data into the table and calculate target


            // Calculate the target score for each bidder
            $target = (($totalRuns / $totalOvers) * ($totalWickets / 20));

            // Execute SQL statement
            $stmt->execute();

            // Display the target score for each bidder
            echo "<div class='target-score'>$bidderName's Target Score: " . number_format($target, 2) . "</div>";

        echo "Data inserted successfully";

        // Close statement and database connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
