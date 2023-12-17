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
                            $output = $result->fetch_assoc();
                            echo json_encode($output);
                        } else {
                            echo "No such a user.";
                        }
                    }
                } else {
                    echo "Menber's id is not set.";
                }
                break;

            case "form":
                if (isset($_POST["mid"])) {
                    if ($conn->connect_error) {
                        echo("DB connection error ".$conn->connect_error);
                    } else {
                        $level = $_POST["level"];
                        $days = $_POST["days"];
                        $goal = $_POST["goal"];
                        $note = $_POST["note"];
                        $mid = $_POST["mid"];
                        $status = $_POST["status"];
                        $instructors = $_POST["instructors"];
                        /* create a prepared statement for UPDATE*/
                        // Ref https://phpdelusions.net/mysqli_examples/update
                        // We don't have to  confirm result by update clause.
                        $sql = "UPDATE `member_tb` SET `status` = ?, `level` = ?, `days` = ?, `goal` = ?, `note` = ? WHERE `member_tb`.`mid` = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("ssissi", $status, $level, $days, $goal, $note, $mid);
                        $stmt->execute();
                        // Below is for passing user information using SELECT
                        $output=[];
                        $sql = "SELECT * FROM `member_tb` WHERE `member_tb`.`mid` = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("i", $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        if($result->num_rows===1) {
                            $output = $result->fetch_assoc();
                        } else {
                            echo "No such a member.";
                        }
                        // for searching instructor's information entered in request form.
                        $sql2 = "SELECT * FROM `instructor_tb` WHERE `fname` = ?";
                        $stmt2= $conn->prepare($sql2);
                        $stmt2->bind_param("s", $instructors);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        $stmt2->close();
                        if($result2->num_rows===1) {
                            array_push($output, $result2->fetch_assoc());
                            echo json_encode($output);
                        } else {
                            echo "No such a instructor.";
                        }
                    }
                } else {
                    echo "This is invalid post request.";
                }
                break;

            case "cards":
                if (isset($_POST["mid"])) {
                    if ($conn->connect_error) {
                        echo("DB connection error ".$conn->connect_error);
                    } else {
                        $mid = $_POST["mid"];
                        // Getting workout data.
                        $output=[];
                        $sql = "SELECT * FROM `workout_tb`";
                        $stmt= $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                array_push($output, $row);
                            }
                            echo json_encode($output);
                        } else {
                            echo "No workout data.";
                        }
                    }
                } else {
                    echo "This is invalid post request.";
                }
                break;
            default:
                echo "'mode' of post request is not set.";
                break;
        }
        break;
    default:
        echo "it is not post.";
        break;
}
