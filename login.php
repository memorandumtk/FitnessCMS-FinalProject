<?php
include './config.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// Database connection setting
$conn = new mysqli(
    $dbServer,
    $dbUser,
    $dbPass,
    $dbName
);

switch($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        if ($conn->connect_error) {
            echo("DB connection error ".$conn->connect_error);
        } else {
            // Changing the table of query based on the value of toggle input.
            if(isset($_POST["kind"]) && $_POST["kind"] == "on") {
                $selectQuery = "SELECT * FROM `member_tb`";
            } else {
                $selectQuery = "SELECT * FROM `instructor_tb`";
            }
            $data = $conn->query($selectQuery);
            $conn->close();

            $output = [];
            if($data->num_rows > 0) {
                while($row = $data->fetch_assoc()) {
                    // Checkiing user information is matched.
                    if($_POST["fname"]==$row["fname"]
                    && $_POST["password"]==$row["pass"]) {
                        session_start();
                        $output = ["sid"=>session_id(),"mid"=>$row["mid"]];
                        echo json_encode(["result"=>$output]);
                        break;
                    }
                }
                if ($output==[]) {
                    echo json_encode(["result"=>"user not found"]);
                }
            } else {
                echo json_encode(["result"=>"no user data"]);
            }
        }
        break;
    default:
        echo json_encode(["result"=>"it is not post."]);
        break;
}
