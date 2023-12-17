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
        switch($_POST["mode"]) {
            case "load":
                if (isset($_POST["mid"])) {
                    if ($conn->connect_error) {
                        echo("DB connection error ".$conn->connect_error);
                    } else {
                        $mid = $_POST["mid"];
                        /* create a prepared statement */
                        // Ref https://phpdelusions.net/mysqli_examples/update
                        // We don't have to  confirm result by update clause.
                        $sql = "SELECT * FROM `member_tb` WHERE `member_tb`.`mid` = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("i", $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        $output=[];
                        if($result->num_rows === 1) {
                            $array = $result->fetch_assoc();
                            while(current($array)) {
                                if (key($array) == "menu") {
                                    if(current($array)==null) {
                                        $output["menu"] = null;
                                    } else {
                                        $output["menu"] = current($array);
                                    }
                                }
                                next(($array));
                            }
                            echo json_encode($output);
                        } else {
                            echo "No such a user.";
                        }
                    }
                } else {
                    echo "Menber's id is not set.";
                }
                break;

            case "display":
                if (isset($_POST["mid"])) {
                    if ($conn->connect_error) {
                        echo("DB connection error ".$conn->connect_error);
                    } else {
                        $level = $_POST["level"];
                        $days = $_POST["days"];
                        $goal = $_POST["goal"];
                        $note = $_POST["note"];
                        $mid = $_POST["mid"];
                        /* create a prepared statement for UPDATE*/
                        // Ref https://phpdelusions.net/mysqli_examples/update
                        // We don't have to  confirm result by update clause.
                        $sql = "UPDATE `member_tb` SET `level` = ?, `days` = ?, `goal` = ?, `note` = ? WHERE `member_tb`.`mid` = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("sissi", $level, $days, $goal, $note, $mid);
                        $stmt->execute();
                    }
                    // Below is for passing user information using SELECT
                    $sql = "SELECT * FROM `member_tb` WHERE `member_tb`.`mid` = ?";
                    $stmt= $conn->prepare($sql);
                    $stmt->bind_param("i", $mid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->close();
                    $output=[];
                    if($result->num_rows === 1) {
                        $output = $result->fetch_assoc();
                        echo json_encode($output);
                    } else {
                        echo "No such a user.";
                    }
                } else {
                    echo "This is invalid post request.";
                }
                break;
            default:
                echo "it is not post.";
                break;
        }
}
