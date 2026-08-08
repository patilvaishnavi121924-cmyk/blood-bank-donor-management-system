<?php

include("../includes/session.php");
include("../database/connection.php");

if(!isset($_SESSION['user_id']))
{
    header("Location:../login.php");
    exit();
}

// Statistics
$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM blood_requests"))['total'];

$pending = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM blood_requests WHERE status='Pending'"))['total'];

$approved = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM blood_requests WHERE status='Approved'"))['total'];

$rejected = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM blood_requests WHERE status='Rejected'"))['total'];

?>

<!DOCTYPE html>
<html>

<head>

<title>Requests Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../admin/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include("../admin/sidebar.php"); ?>

<div class="main-content">

<?php include("../admin/topbar.php"); ?>

<div class="container-fluid mt-4">

<h2 class="mb-4">

<i class="fa-solid fa-droplet text-danger"></i>

Blood Requests Dashboard

</h2>

<div class="row">

<div class="col-md-6 mb-4">

<div class="card shadow border-0 h-100">

<div class="card-body text-center">

<i class="fa-solid fa-hand-holding-droplet fa-4x text-danger mb-3"></i>

<h3>Request Blood</h3>

<p class="text-muted">

Submit a new blood request.

</p>

<a href="request_blood.php" class="btn btn-danger px-4">

<i class="fa-solid fa-plus"></i>

Request Blood

</a>

</div>

</div>

</div>

<div class="col-md-6 mb-4">

<div class="card shadow border-0 h-100">

<div class="card-body text-center">

<i class="fa-solid fa-clock-rotate-left fa-4x text-primary mb-3"></i>

<h3>Request History</h3>

<p class="text-muted">

View all your previous requests.

</p>

<a href="request_history.php" class="btn btn-primary px-4">

<i class="fa-solid fa-eye"></i>

View History

</a>

</div>

</div>

</div>

</div>


<div class="row mt-2">

<div class="col-md-3 mb-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-list fa-2x text-dark mb-2"></i>

<h5>Total Requests</h5>

<h2><?php echo $total; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-hourglass-half fa-2x text-warning mb-2"></i>

<h5>Pending</h5>

<h2><?php echo $pending; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-circle-check fa-2x text-success mb-2"></i>

<h5>Approved</h5>

<h2><?php echo $approved; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-circle-xmark fa-2x text-danger mb-2"></i>

<h5>Rejected</h5>

<h2><?php echo $rejected; ?></h2>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>