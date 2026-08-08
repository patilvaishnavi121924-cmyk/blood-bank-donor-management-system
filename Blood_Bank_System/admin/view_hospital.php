<?php

include("../includes/session.php");
include("../database/connection.php");

if(!isset($_SESSION['user_id']))
{
    header("Location:../login.php");
    exit();
}

if(!isset($_GET['id']))
{
    header("Location:hospital.php");
    exit();
}

$id = intval($_GET['id']);

$query = mysqli_query($conn,"SELECT * FROM hospitals WHERE hospital_id='$id'");

if(mysqli_num_rows($query)==0)
{
    header("Location:hospital.php");
    exit();
}

$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>

<head>

<title>View Hospital</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-danger text-white">

<h4>

<i class="fa-solid fa-hospital"></i>

Hospital Details

</h4>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>
<th width="30%">Hospital Name</th>
<td><?php echo $row['hospital_name']; ?></td>
</tr>

<tr>
<th>Contact Person</th>
<td><?php echo $row['contact_person']; ?></td>
</tr>

<tr>
<th>Mobile</th>
<td><?php echo $row['mobile']; ?></td>
</tr>

<tr>
<th>Email</th>
<td><?php echo $row['email']; ?></td>
</tr>

<tr>
<th>Address</th>
<td><?php echo $row['address']; ?></td>
</tr>

<tr>
<th>City</th>
<td><?php echo $row['city']; ?></td>
</tr>

<tr>
<th>Status</th>
<td>

<?php

if($row['status']=="Approved")
{
    echo "<span class='badge bg-success'>Approved</span>";
}
else
{
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}

?>

</td>

</tr>

</table>

<a href="hospital.php" class="btn btn-secondary">

<i class="fa-solid fa-arrow-left"></i>

Back

</a>

</div>

</div>

</div>

</div>

</body>

</html>