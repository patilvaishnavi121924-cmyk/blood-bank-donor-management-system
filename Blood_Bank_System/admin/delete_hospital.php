<?php

include("../includes/session.php");
include("../database/connection.php");

if(!isset($_SESSION['user_id']))
{
    header("Location:../login.php");
    exit();
}

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);

    $delete = mysqli_query($conn,
    "DELETE FROM hospitals WHERE hospital_id='$id'");

    if($delete)
    {
        header("Location:hospital.php?msg=deleted");
        exit();
    }
    else
    {
        header("Location:hospital.php?msg=error");
        exit();
    }
}
else
{
    header("Location:hospital.php");
    exit();
}

?>