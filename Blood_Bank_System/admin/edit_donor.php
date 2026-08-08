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

if(isset($_POST['update']))
{

$full_name=$_POST['full_name'];
$gender=$_POST['gender'];
$dob=$_POST['dob'];
$blood_group=$_POST['blood_group'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$address=$_POST['address'];
$city=$_POST['city'];
$weight=$_POST['weight'];
$last_donation=$_POST['last_donation'];
$status=$_POST['status'];

$update=mysqli_query($conn,"UPDATE donors SET

full_name='$full_name',

gender='$gender',

dob='$dob',

blood_group='$blood_group',

mobile='$mobile',

email='$email',

address='$address',

city='$city',

weight='$weight',

last_donation='$last_donation',

status='$status'

WHERE donor_id='$id'");

if($update)
{

echo "<script>

alert('Donor Updated Successfully');

window.location='donor.php';

</script>";

}

else
{

echo "<script>

alert('Update Failed');

</script>";

}

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Donor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Donor</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Full Name</label>

<input

type="text"

name="full_name"

class="form-control"

value="<?php echo $row['full_name']; ?>"

required>

</div>

<div class="col-md-6 mb-3">

<label>Gender</label>

<select

name="gender"

class="form-select">

<option <?php if($row['gender']=="Male") echo "selected"; ?>>Male</option>

<option <?php if($row['gender']=="Female") echo "selected"; ?>>Female</option>

<option <?php if($row['gender']=="Other") echo "selected"; ?>>Other</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>DOB</label>

<input

type="date"

name="dob"

class="form-control"

value="<?php echo $row['dob']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Blood Group</label>

<input

type="text"

name="blood_group"

class="form-control"

value="<?php echo $row['blood_group']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Mobile</label>

<input

type="text"

name="mobile"

class="form-control"

value="<?php echo $row['mobile']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input

type="email"

name="email"

class="form-control"

value="<?php echo $row['email']; ?>">

</div>

<div class="col-md-12 mb-3">

<label>Address</label>

<textarea

name="address"

class="form-control"><?php echo $row['address']; ?></textarea>

</div>

<div class="col-md-6 mb-3">

<label>City</label>

<input

type="text"

name="city"

class="form-control"

value="<?php echo $row['city']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Weight</label>

<input

type="number"

name="weight"

class="form-control"

value="<?php echo $row['weight']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Last Donation</label>

<input

type="date"

name="last_donation"

class="form-control"

value="<?php echo $row['last_donation']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select

name="status"

class="form-select">

<option <?php if($row['status']=="Active") echo "selected"; ?>>Active</option>

<option <?php if($row['status']=="Inactive") echo "selected"; ?>>Inactive</option>

</select>

</div>

</div>

<button

type="submit"

name="update"

class="btn btn-warning">

Update Donor

</button>

<a href="donor.php" class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

</body>

</html>

