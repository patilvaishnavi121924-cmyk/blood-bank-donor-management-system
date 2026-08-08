<?php

include("../includes/session.php");
include("../database/connection.php");

if(!isset($_SESSION['user_id']))
{
    header("Location:../login.php");
    exit();
}

$ngo_id = $_SESSION['user_id'];

$totalRequests = 0;
$approvedRequests = 0;
$pendingRequests = 0;
$totalCamps = 0;

/* Total Requests */
$q1 = mysqli_query($conn,"SELECT COUNT(*) AS total FROM blood_requests
WHERE user_type='NGO' AND user_id='$ngo_id'");
if($q1)
{
    $row=mysqli_fetch_assoc($q1);
    $totalRequests=$row['total'];
}

/* Approved Requests */
$q2 = mysqli_query($conn,"SELECT COUNT(*) AS total FROM blood_requests
WHERE user_type='NGO'
AND user_id='$ngo_id'
AND status='Approved'");
if($q2)
{
    $row=mysqli_fetch_assoc($q2);
    $approvedRequests=$row['total'];
}

/* Pending Requests */
$q3 = mysqli_query($conn,"SELECT COUNT(*) AS total FROM blood_requests
WHERE user_type='NGO'
AND user_id='$ngo_id'
AND status='Pending'");
if($q3)
{
    $row=mysqli_fetch_assoc($q3);
    $pendingRequests=$row['total'];
}

/* Total Camps */
$q4 = mysqli_query($conn,"SELECT COUNT(*) AS total FROM blood_camps
WHERE ngo_id='$ngo_id'");
if($q4)
{
    $row=mysqli_fetch_assoc($q4);
    $totalCamps=$row['total'];
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>NGO Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../admin/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container-fluid mt-4">

<h2 class="mb-4">

Welcome,

<?php echo $_SESSION['user_name']; ?>

</h2>

<div class="row">

<div class="col-md-3 mb-4">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-campground fa-2x text-danger mb-3"></i>

<h5>Total Camps</h5>

<h2><?php echo $totalCamps; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-droplet fa-2x text-primary mb-3"></i>

<h5>Total Requests</h5>

<h2><?php echo $totalRequests; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-circle-check fa-2x text-success mb-3"></i>

<h5>Approved</h5>

<h2><?php echo $approvedRequests; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="fa-solid fa-clock fa-2x text-warning mb-3"></i>

<h5>Pending</h5>

<h2><?php echo $pendingRequests; ?></h2>

</div>

</div>

</div>

</div>

<div class="card shadow">

<div class="card-header bg-danger text-white">

Recent Blood Requests

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>ID</th>

<th>Patient</th>

<th>Blood Group</th>

<th>Units</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query($conn,"
SELECT *
FROM blood_requests
WHERE user_type='NGO'
AND user_id='$ngo_id'
ORDER BY request_id DESC
LIMIT 5");

if(mysqli_num_rows($query)>0)
{

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['request_id']; ?></td>

<td><?php echo $row['patient_name']; ?></td>

<td><?php echo $row['blood_group']; ?></td>

<td><?php echo $row['units']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php

}

}
else
{

?>

<tr>

<td colspan="5" class="text-center">

No Requests Found

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>

</html>