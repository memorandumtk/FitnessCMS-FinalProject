<?php
include './config.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$conn = new mysqli(
    $dbServer,
    $dbUser,
    $dbPass,
    $dbName
);

if ($conn->connect_error) {
    echo("DB connection error ".$conn->connect_error);
} else {
    $selectQuery = "SELECT * FROM `member_tb`";
    $data = $conn->query($selectQuery);
    print_r($data);
    print_r('<br>'); // This line is for breking line when we check the output on the browser
    $conn->close();
    $output = [];
    if($data->num_rows > 0) {
        while($row = $data->fetch_assoc()) {
            print_r($row);
            print_r('<br>');
            // password verify method goes here...?
            array_push($output, $row);
        }
        print_r('<br>');
        print_r($output);
    }

}
