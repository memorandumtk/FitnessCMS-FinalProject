<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  switch ($_POST["req"]) {
    case "mreg":
      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $age = $_POST["age"];
      $phone = $_POST["phone"];
      $gen = $_POST["gen"];
      $email = $_POST["email"];
      $pass = $_POST["pass"];

      $conn = new mysqli("localhost", "phpagent", "orca123", "orca_fitness");
      if ($conn->connect_error) {
        die("Connection Failed :" . $conn->connect_error);
      } else {
        $stmt = $conn->prepare("INSERT INTO member_tb(fname,lname,email,pass,phone,gender,age) Value(?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssi", $fname, $lname, $email, $pass, $phone, $gen, $age);
        $stmt->execute();
        echo "regisration succuessfully...";
        $stmt->close();
        $conn->close();
      }
      break;
    case "ireg":
      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $age = $_POST["age"];
      $phone = $_POST["phone"];
      $gen = $_POST["gen"];
      $email = $_POST["email"];
      $pass = $_POST["pass"];

      $conn = new mysqli("localhost", "phpagent", "orca123", "orca_fitness");
      if ($conn->connect_error) {
        die("Connection Failed :" . $conn->connect_error);
      } else {
        $stmt = $conn->prepare("INSERT INTO instructor_tb(fname,lname,email,pass,phone,gender,age) Value(?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssi", $fname, $lname, $email, $pass, $phone, $gen, $age);
        $stmt->execute();
        echo "regisration succuessfully...";
        $stmt->close();
        $conn->close();
      }
      break;
    case "read":
      $conn = new mysqli("localhost", "phpagent", "orca123", "orca_fitness");
      if ($conn->connect_error) {
        die("Connection Failed :" . $conn->connect_error);
      } else {
        $mQuery = "SELECT fname,lname,gender,email FROM member_tb";
        $iQuery = "SELECT fname,lname,gender,email FROM instructor_tb";
        $mdata = $conn->query($mQuery);
        $idata = $conn->query($iQuery);
        $mData = [];
        $iData = [];
        if ($mdata->num_rows > 0) {
          while ($row = $mdata->fetch_assoc()) {
            array_push($mData, $row);
          }
        }
        if ($idata->num_rows > 0) {
          while ($row = $idata->fetch_assoc()) {
            array_push($iData, $row);
          }
        }
        $arr = array($mData, $iData);
        echo json_encode($arr);
      }
      break;
    case "mdel":
      $mdel = json_decode($_POST['mdel']);
      $memail = $mdel->email;
      $conn = new mysqli("localhost", "phpagent", "orca123", "orca_fitness");
      echo ($memail);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $targetEmail = $memail;
      $sql = "DELETE FROM member_tb WHERE email = '$targetEmail'";
      if ($conn->query($sql) === TRUE) {
        echo "User data with email $targetEmail deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }
      $conn->close();
      break;
    case "idel":
      $idel = json_decode($_POST['idel']);
      $iemail = $idel->email;
      $conn = new mysqli("localhost", "phpagent", "orca123", "orca_fitness");
      echo ($iemail);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $targetEmail = $iemail;
      $sql = "DELETE FROM instructor_tb WHERE email = '$targetEmail'";
      if ($conn->query($sql) === TRUE) {
        echo "User data with email $targetEmail deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }
      $conn->close();
      break;
    case "login";
      $conn = new mysqli("localhost", "phpagent", "orca123", "orca_fitness");
      if ($conn->connect_error) {
        die("Connection Failed :" . $conn->connect_error);
      } else {
        $ad = "SELECT aid,fname,lname,email,pass FROM admin_tb ";
        $adata = $conn->query($ad);
        $conn->close();
        $output = [];

        if ($adata->num_rows > 0) {
          while ($row = $adata->fetch_assoc()) {
            array_push($output, $row);
          }
        }else{
          echo "no data";
        }
        session_start();
        foreach($output as $user){
          if($user["email"] == $_POST["email"] && $user["pass"]== $_POST["pass"]){
             $student = $user;
             $_SESSION["userVal"] = $student;
             $response = ["sid"=>session_id(),"name"=>$user["fname"],"aid"=>$user["aid"]];
             echo json_encode($response);
             break;
          }
       }
      }
      
  }
}