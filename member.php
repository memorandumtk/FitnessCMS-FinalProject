<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  switch($_POST["req"]){
    case "mlogin":
  $fname=$_POST["fname"];
$lname=$_POST["lname"];
$age=$_POST["age"];
$phone=$_POST["phone"];
$gen=$_POST["gen"];
$email=$_POST["email"];
$pass=$_POST["pass"];

$conn =new mysqli("localhost","tsubasa","tsubasa1213","orca_fitness");
if($conn->connect_error){
  die("Connection Failed :" .$conn->connect_error);
}else{
$stmt=$conn->prepare("INSERT INTO member_tb(fname,lname,email,pass,phone,gender,age) Value(?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssi",$fname,$lname,$email,$pass,$phone,$gen,$age);
$stmt->execute();
echo"regisration succuessfully...";
$stmt->close();
$conn->close();
}
break;
case "ilogin":
  $fname=$_POST["fname"];
$lname=$_POST["lname"];
$age=$_POST["age"];
$phone=$_POST["phone"];
$gen=$_POST["gen"];
$email=$_POST["email"];
$pass=$_POST["pass"];

$conn =new mysqli("localhost","tsubasa","tsubasa1213","orca_fitness");
if($conn->connect_error){
  die("Connection Failed :" .$conn->connect_error);
}else{
$stmt=$conn->prepare("INSERT INTO instructor_tb(fname,lname,email,pass,phone,gender,age) Value(?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssi",$fname,$lname,$email,$pass,$phone,$gen,$age);
$stmt->execute();
echo"regisration succuessfully...";
$stmt->close();
$conn->close();
}
break;
} 
}


?>