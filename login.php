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
            if(isset($_POST["kind"])) {
                if($_POST["kind"] == "on"){
                    $selectQuery = "SELECT * FROM `member_tb`"; //member
                }else{
                    $selectQuery = "SELECT * FROM `instructor_tb`"; //instructor
                }
            } else {
                $selectQuery = "SELECT * FROM `admin_tb`";  //admin
            }
            $data = $conn->query($selectQuery);
            $conn->close();

            $output = [];
            if($data->num_rows > 0) {
                while($row = $data->fetch_assoc()) {
                    // Checkiing user information is matched.
                    if($_POST["email"]==$row["email"]
                    && $_POST["password"]==$row["pass"]) {
                        session_start();
                        if(isset($_POST["kind"])) {
                            if($_POST["kind"] == "on"){
                                $output = ["sid"=>session_id(),"id"=>$row["mid"],"uname"=>$row["fname"]];   //member
                            }else{
                                $output = ["sid"=>session_id(),"id"=>$row["iid"],"uname"=>$row["fname"]];   //instructor
                            }
                        } else {
                            $output = ["sid"=>session_id(),"id"=>$row["aid"],"uname"=>$row["fname"]];   //admin
                        }
                        
                        echo json_encode($output);
                        break;
                    }
                }
                if ($output==[]) {
                    echo json_encode("user not found");
                }
            } else {
                echo json_encode("no user data");
            }
        }
        break;
    default:
        echo json_encode("it is not post.");
        break;
}