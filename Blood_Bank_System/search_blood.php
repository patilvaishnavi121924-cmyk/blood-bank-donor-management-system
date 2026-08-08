<?php
include("includes/session.php");
include("database/connection.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");   // or ../login.php depending on your folder
    exit();
}

include("includes/header.php");
include("includes/navbar.php");
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Search Blood</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../admin/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="container mt-5">
<div class="card shadow">

<div class="card-header bg-danger text-white">

<h4>

<i class="fa-solid fa-magnifying-glass"></i>

Search Blood Availability

</h4>

</div>

<div class="card-body">

<form method="GET">

<div class="row">

<div class="col-md-6">

<select
name="blood_group"
class="form-select"
required>

<option value="">Select Blood Group</option>

<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>AB+</option>
<option>AB-</option>
<option>O+</option>
<option>O-</option>

</select>

</div>

<div class="col-md-3">

<button
class="btn btn-danger">

Search

</button>

</div>

</div>

</form>

<br>

<?php

if(isset($_GET['blood_group']))
{

$blood_group=mysqli_real_escape_string($conn,$_GET['blood_group']);

$query=mysqli_query($conn,"
SELECT *
FROM blood_stock
WHERE blood_group='$blood_group'");

if(mysqli_num_rows($query)>0)
{

$row=mysqli_fetch_assoc($query);

?>

<table class="table table-bordered">

<tr>

<th>Blood Group</th>

<td><?php echo $row['blood_group']; ?></td>

</tr>

<tr>

<th>Available Units</th>

<td>

<?php

if($row['units']>0)
{

echo "<span class='badge bg-success fs-6'>".$row['units']." Units Available</span>";

}
else
{

echo "<span class='badge bg-danger fs-6'>Out of Stock</span>";

}

?>

</td>

</tr>

<tr>

<th>Last Updated</th>

<td>

<?php echo $row['last_updated']; ?>

</td>

</tr>

</table>

<?php

}
else
{

?>

<div class="alert alert-danger">

Blood Group Not Found.

</div>

<?php

}

}

?>

</div>

</div>

</div>

</div>

</body>

</html>