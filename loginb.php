<?php
include("DB/dbconn.php");

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$_SESSION["username"]=$_REQUEST['username'];
$_SESSION["password"]=$_REQUEST['password'];

if(isset($_REQUEST['email'])){
    $email = $_REQUEST['email'];
    $_SESSION["email"]=$_REQUEST['email'];
    $sql = "SELECT * FROM `users` WHERE username = '$username' ";
    $result = mysqli_query($conn ,$sql);
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
        $_SESSION["message"] = "user all ready exist";
        header("Location:login.php");
        exit();
    }else{
        $email = $_REQUEST["email"];
        $otp = rand(1111,9999);
        $_SESSION["email"]=$email;
        $_SESSION["otp"] = $otp; 
        $to_email = $email;
        $subject = "forget password";
        $body = "Hi, you otp is $otp";
        $headers = "From: shahid576ali@gmail.com";

        if (mail($to_email, $subject, $body, $headers)) {
                
            header("Location:verify.php");
            exit();
        } else {
            echo "error found check your internet connection";
           // header("Location:sendotp.php");
            exit();
        }
    
    }
}else{
    $sql = "SELECT * FROM `users` WHERE username = '$username' and password='$password'";
    $result = mysqli_query($conn ,$sql);
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
        $_SESSION['user_id'] = $row["id"];
        $_SESSION['role_id'] = $row["role_id"];
        $_SESSION['user_name'] = $row["username"];
        $sql = "SELECT * FROM `role_teams` WHERE `user_id` = '".$row["id"]."'";
        $result = mysqli_query($conn ,$sql);
        $row  = mysqli_fetch_array($result);
        $_SESSION['team_id'] = $row["team_id"];
        header("Location:index.php");
        exit();
    } else {
        $_SESSION["message"] = "Invalid Username or Password!";
        header("Location:login.php");
        exit();
        }
}




?>