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
                        $sql3 = "SELECT * FROM `programs_tb` WHERE `mid` = ?";
                        $stmt3= $conn->prepare($sql3);
                        $stmt3->bind_param("i", $mid);
                        $stmt3->execute();
                        $result3 = $stmt3->get_result();
                        $stmt3->close();
                        $isRequest;
                        if($result3->num_rows>0) {
                            $isRequest["request"] = true;
                            array_push($output, $isRequest);
                        } else {
                            $isRequest["request"] = false;
                            array_push($output, $isRequest);
                        }
                        echo json_encode($output);
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
                        $ifname = $_POST["instructors"];
                        // Search the member based on mid to get fname and lname of the member.
                        $sql = "SELECT * FROM `member_tb` WHERE `member_tb`.`mid` = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("i", $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        if($result->num_rows === 1) {
                            $member = $result->fetch_assoc();
                            echo json_encode($member);
                        } else {
                            echo "Can't find the user.";
                        }
                        // Insert to requests table based on the value of form.
                        $sql2 = "INSERT INTO `requests_tb`(`memid`, `memfname`, `memlname`, `dlevel`, `dpw`, `instructor`, `goal`, `notes`)
                        VALUES (?,?,?,?,?,?,?,?)";
                        $stmt2= $conn->prepare($sql2);
                        $stmt2->bind_param("isssisss", $mid, $member["fname"], $member["lname"], $level, $days, $ifname, $goal, $note);
                        $stmt2->execute();
                        $stmt2->close();
                    }
                } else {
                    echo "Menber's id is not set.";
                }
                break;

            case "get-my-workouts":
                if (isset($_POST["mid"])) {
                    if ($conn->connect_error) {
                        echo("DB connection error ".$conn->connect_error);
                    } else {
                        $mid = $_POST["mid"];
                        $output=[];
                        // Select from programs table based on mid.
                        $sql = "SELECT * FROM `programs_tb` INNER JOIN `workouts_tb` ON programs_tb.wid = workouts_tb.wid WHERE programs_tb.mid = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("i", $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                array_push($output, $row);
                            }
                            echo json_encode($output);
                        } else {
                            echo false;
                        }
                    }
                } else {
                    echo "Menber's id is not set.";
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

            case "get-my-requests":
                if (isset($_POST["mid"])) {
                    if ($conn->connect_error) {
                        echo("DB connection error ".$conn->connect_error);
                    } else {
                        // Getting requests data based on member id.
                        $output=[];
                        $mid = $_POST["mid"];
                        $sql = "SELECT * FROM `requests_tb` WHERE `memid` = ?";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("i", $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                array_push($output, $row);
                            }
                            echo json_encode($output);
                        } else {
                            echo "You haven't sent requests yet.";
                        }
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
