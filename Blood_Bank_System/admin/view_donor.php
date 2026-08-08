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
    header("Location:donor.php");
    exit();
}

$id = intval($_GET['id']);

$query = mysqli_query($conn,"SELECT * FROM donors WHERE donor_id='$id'");

if(mysqli_num_rows($query)==0)
{
    header("Location:donor.php");
    exit();
}

$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
<head>

<title>View Donor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container mt-4">

<div class="card shadow border-0">

<div class="card-header bg-danger text-white">

<h3 class="mb-0">

<i class="fa-solid fa-user"></i>

Donor Profile

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<p><strong>Full Name :</strong> <?php echo $row['full_name']; ?></p>

<p><strong>Gender :</strong> <?php echo $row['gender']; ?></p>

<p><strong>Date of Birth :</strong> <?php echo $row['dob']; ?></p>

<p><strong>Blood Group :</strong>

<span class="badge bg-danger">

<?php echo $row['blood_group']; ?>

</span>

</p>

<p><strong>Weight :</strong> <?php echo $row['weight']; ?> Kg</p>

<p><strong>Last Donation :</strong> <?php echo $row['last_donation']; ?></p>

</div>

<div class="col-md-6">

<p><strong>Mobile :</strong> <?php echo $row['mobile']; ?></p>

<p><strong>Email :</strong> <?php echo $row['email']; ?></p>

<p><strong>City :</strong> <?php echo $row['city']; ?></p>

<p><strong>Address :</strong> <?php echo $row['address']; ?></p>

<p>

<strong>Status :</strong>

<?php

if($row['status']=="Active")
{

echo "<span class='badge bg-success'>Active</span>";

}
else
{

echo "<span class='badge bg-danger'>Inactive</span>";

}

?>

</p>

</div>

</div>

<hr>

<a href="edit_donor.php?id=<?php echo $row['donor_id']; ?>" class="btn btn-warning">

<i class="fa fa-edit"></i>

Edit

</a>

<a href="donor.php" class="btn btn-secondary">

<i class="fa fa-arrow-left"></i>

Back

</a>

</div>

</div>

</div>

</div>

</body>

</html>