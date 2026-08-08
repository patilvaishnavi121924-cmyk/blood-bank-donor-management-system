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

    $delete = mysqli_query($conn, "DELETE FROM donors WHERE donor_id='$id'");

    if($delete)
    {
        header("Location:donor.php?msg=deleted");
    }
    else
    {
        header("Location:donor.php?msg=error");
    }
}
else
{
    header("Location:donor.php");
}

?>