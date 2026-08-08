<?php

include("../includes/session.php");
include("../database/connection.php");

if(!isset($_SESSION['user_id']))
{
    header("Location:../login.php");
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM blood_stock ORDER BY blood_group ASC");

?>

<!DOCTYPE html>

<html>

<head>

<title>Blood Stock</title>

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

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>

<i class="fa-solid fa-droplet text-danger"></i>

Blood Stock

</h2>

</div>

<div class="card shadow">

<div class="card-header bg-danger text-white">

<h5 class="mb-0">

Available Blood Units

</h5>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover align-middle">

<thead class="table-light">

<tr>

<th>#</th>

<th>Blood Group</th>

<th>Units Available</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($result))
{

$units=$row['units'];

if($units==0)
{
$status="<span class='badge bg-danger'>Out of Stock</span>";
}
elseif($units<=5)
{
$status="<span class='badge bg-warning text-dark'>Low Stock</span>";
}
else
{
$status="<span class='badge bg-success'>Available</span>";
}

?>

<tr>

<td><?php echo $no++; ?></td>

<td>

<strong>

<?php echo $row['blood_group']; ?>

</strong>

</td>

<td>

<?php echo $units; ?>

 Units

</td>

<td>

<?php echo $status; ?>

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

</div>

</body>

</html>