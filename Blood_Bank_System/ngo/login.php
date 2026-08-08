<?php
session_start();
include("../database/connection.php");

$message="";

if(isset($_POST['login']))
{
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=$_POST['password'];

    $query=mysqli_query($conn,"SELECT * FROM ngos WHERE email='$email'");

    if(mysqli_num_rows($query)==1)
    {
        $row=mysqli_fetch_assoc($query);

        if(password_verify($password,$row['password']))
        {
            $_SESSION['user_id']=$row['ngo_id'];
            $_SESSION['user_name']=$row['ngo_name'];
            $_SESSION['user_type']="NGO";

            header("Location:dashboard.php");
            exit();
        }
        else
        {
            $message="Incorrect Password.";
        }
    }
    else
    {
        $message="Email Not Registered.";
    }
}
?>