<?php
include("../includes/session.php");
include("../database/connection.php");
include("../includes/functions.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_type']!="Admin")
{
    header("Location:../admin/dashboard.php");
    
    exit();
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container-fluid mt-4">

<?php

$donors = getCount($conn, "donors");

$hospitals = getCount($conn, "hospitals");

$ngos = getCount($conn, "ngos");

$bloodUnits = getBloodUnits($conn);

?>

<div class="row g-4">

<div class="col-md-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-users fa-3x text-danger"></i>

<h2><?php echo $donors; ?></h2>

<p>Total Donors</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-hospital fa-3x text-primary"></i>

<h2><?php echo $hospitals; ?></h2>

<p>Hospitals</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-handshake fa-3x text-success"></i>

<h2><?php echo $ngos; ?></h2>

<p>NGOs</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-droplet fa-3x text-danger"></i>
<h2><?php echo $bloodUnits; ?></h2>
<p>Blood Units</p>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>