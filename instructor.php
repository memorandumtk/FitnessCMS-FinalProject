<?php
    include("./config.php");
    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Headers: *");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        switch($_POST["mode"]){

            // Get the requests from the database to show them in instructors main dashboard
            case "load-requests":
            $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
            if($conn->connect_error) {
                echo "DB Connection Error: " . $conn->connect_error;
            } else {
                // Get the data where instructor is Arnold
                $selectQuery = "SELECT * FROM requests_tb";
                // Run the query string using the $conn connection
                $data = $conn->query($selectQuery);
                $outData = [];
                // If the rows in the data is greater than 0 (means it could get some data)
                if($data->num_rows > 0) {
                    // fetch_assoc is getting each item of the assoc array in the data, put it in $row and pushing each $row into the $outData array
                    while ($row = $data->fetch_assoc()) {
                        array_push($outData, $row);
                    };
                    echo json_encode($outData);
                } else {
                    echo ("No data found");
                }
                $conn->close();
            break;
            };


            // Get the workouts from database in order to show them when creating a workout program
            case "load-workouts":
                $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
            if($conn->connect_error) {
                echo "DB Connection Error: " . $conn->connect_error;
            } else {
                // Get the data where instructor is Arnold
                $selectQuery = "SELECT * FROM workouts_tb";
                // Run the query string using the $conn connection
                $data = $conn->query($selectQuery);
                $outData = [];
                // If the rows in the data is greater than 0 (means it could get some data)
                if($data->num_rows > 0) {
                    // fetch_assoc is getting each item of the assoc array in the data, put it in $row and pushing each $row into the $outData array
                    while ($row = $data->fetch_assoc()) {
                        array_push($outData, $row);
                    };
                    echo json_encode($outData);
                } else {
                    echo ("No data found");
                }
                $conn->close();
            break;
            };


            // Finds the members request in database and deletes it
            case "reject":
                $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
            if($conn->connect_error) {
                echo "DB Connection Error: " . $conn->connect_error;
            } else {
                // Get the data where instructor is Arnold
                $memid = $_POST["mid"];
                $selectQuery = "DELETE FROM requests_tb WHERE `requests_tb`.`memid`= $memid";
                // Run the query string using the $conn connection
                $data = $conn->query($selectQuery);
                if($conn->query($insertQuery)===TRUE) {
                    echo "1 row deleted";
                } else {
                    echo "Error: " . $conn->error;
                };
                $conn->close();
            break;
            };


            // Get the created workout program information and adds a new row into the programs database. These will show in the instructors active programs page
            case "create":
                $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
            if($conn->connect_error) {
                echo "DB Connection Error: " . $conn->connect_error;
            } else {
                // Assign received data to variables in order to use them in sql query.
                $memid = $_POST["memid"];
                $mfname = $_POST["mfname"];
                    $pworkouts = $_POST["workouts"];
                $inotes = $_POST["inotes"];

                // Create query command, prepare variables and bind parameters in order to correctly execute query. 
                $query = "INSERT INTO programs_tb (mid, mfname, iid, ifname, wids, inotes) VALUES(?, ?, '111', 'Ronnie', ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("isss", $memid, $mfname, $pworkouts, $inotes);
                $stmt->execute();
                $conn->close();
            break;
            };


            // Get the requests from the database to show them in instructors main dashboard
            case "load-programs":
                $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
                if($conn->connect_error) {
                    echo "DB Connection Error: " . $conn->connect_error;
                } else {
                    // Get the data where instructor is Arnold
                    $selectQuery = "SELECT * FROM programs_tb";
                    // Run the query string using the $conn connection
                    $data = $conn->query($selectQuery);
                    $outData = [];
                    // If the rows in the data is greater than 0 (means it could get some data)
                    if($data->num_rows > 0) {
                        // fetch_assoc is getting each item of the assoc array in the data, put it in $row and pushing each $row into the $outData array
                        while ($row = $data->fetch_assoc()) {
                            array_push($outData, $row);
                        };
                        echo json_encode($outData);
                    } else {
                        echo ("No data found");
                    }
                    $conn->close();
                break;
            };


            // Finds the members request in database and deletes it
            case "end":
                $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
            if($conn->connect_error) {
                echo "DB Connection Error: " . $conn->connect_error;
            } else {
                // Get the data where instructor is Arnold
                $memid = $_POST["mid"];
                $selectQuery = "DELETE FROM programs_tb WHERE `programs_tb`.`mid`= $memid";
                // Run the query string using the $conn connection
                $data = $conn->query($selectQuery);
                if($conn->query($insertQuery)===TRUE) {
                    echo "1 row deleted";
                } else {
                    echo "Error: " . $conn->error;
                };
                $conn->close();
            break;
            };
        };
    };

?>