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
                        $output=[];
                        // Select query for searching a member will be matched.
                        $sql = "SELECT * FROM `member_tb` WHERE `member_tb`.`mid` = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("i", $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        $member=[];
                        if($result->num_rows === 1) {
                            $member = $result->fetch_assoc();
                            array_push($output, $member);
                        } else {
                            echo "No such a user.";
                        }
                        // Select query for outputting all of instructors
                        $sql2 = "SELECT * FROM `instructor_tb`";
                        $stmt2= $conn->prepare($sql2);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        $stmt2->close();
                        $instructors = [];
                        if($result2->num_rows>0) {
                            while($row = $result2->fetch_assoc()) {
                                array_push($instructors, $row);
                            }
                            array_push($output, $instructors);
                        } else {
                            echo "No instructors.";
                        }
                        // Select query for outputting all of workouts
                        $sql3 = "SELECT * FROM `workouts_tb`";
                        $stmt3= $conn->prepare($sql3);
                        $stmt3->execute();
                        $result3 = $stmt3->get_result();
                        $stmt3->close();
                        $workouts = [];
                        if($result3->num_rows>0) {
                            while($row = $result3->fetch_assoc()) {
                                array_push($workouts, $row);
                            }
                            array_push($output, $workouts);
                            echo json_encode($output);
                        } else {
                            echo "No workouts.";
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
                        $ifname = $_POST["instructors"];
                        /* create a prepared statement for UPDATE*/
                        // Ref https://phpdelusions.net/mysqli_examples/update
                        // We don't have to  confirm result by update clause.
                        $sql = "UPDATE `member_tb` SET `status` = ?, `level` = ?, `days` = ?, `goal` = ?, `note` = ?, `ifname` = ? WHERE `member_tb`.`mid` = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("ssisssi", $status, $level, $days, $goal, $note, $ifname, $mid);
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
                        $stmt2->bind_param("s", $ifname);
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

            case "get-my-workouts":
                if (isset($_POST["mid"])) {
                    if ($conn->connect_error) {
                        echo("DB connection error ".$conn->connect_error);
                    } else {
                        $mid = $_POST["mid"];
                        // Getting workout data.
                        // -
                        // -
                        // -
                        // -
                        // -
                        // -
                        // inner join clause is gonna be here...
                        // -
                        // -
                        // -
                        // -
                        // -
                        $output=[];
                        $sql = "SELECT * FROM `programs_tb`";
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
            case "get-all-workouts":
                if ($conn->connect_error) {
                    echo("DB connection error ".$conn->connect_error);
                } else {
                    // Getting workout data from workouts table.
                    $output=[];
                    $sql = "SELECT * FROM `workouts_tb`";
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
