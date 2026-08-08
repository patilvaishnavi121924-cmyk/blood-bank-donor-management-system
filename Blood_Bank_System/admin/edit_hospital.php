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

if(isset($_POST['update']))
{

    $hospital_name = mysqli_real_escape_string($conn,$_POST['hospital_name']);
    $contact_person = mysqli_real_escape_string($conn,$_POST['contact_person']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);

    $update = mysqli_query($conn,"
    UPDATE hospitals SET
    hospital_name='$hospital_name',
    contact_person='$contact_person',
    mobile='$mobile',
    email='$email',
    address='$address',
    city='$city',
    status='$status'
    WHERE hospital_id='$id'
    ");

    if($update)
    {
        header("Location:hospital.php?msg=updated");
        exit();
    }
    else
    {
        echo "<div class='alert alert-danger'>Update Failed.</div>";
    }

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Hospital</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-warning">

<h4>
<i class="fa-solid fa-pen"></i>
Edit Hospital
</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Hospital Name</label>
<input type="text" name="hospital_name" class="form-control"
value="<?php echo $row['hospital_name']; ?>" required>
</div>

<div class="mb-3">
<label>Contact Person</label>
<input type="text" name="contact_person" class="form-control"
value="<?php echo $row['contact_person']; ?>" required>
</div>

<div class="mb-3">
<label>Mobile</label>
<input type="text" name="mobile" class="form-control"
value="<?php echo $row['mobile']; ?>" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control"
value="<?php echo $row['email']; ?>" required>
</div>

<div class="mb-3">
<label>Address</label>
<textarea name="address" class="form-control" required><?php echo $row['address']; ?></textarea>
</div>

<div class="mb-3">
<label>City</label>
<input type="text" name="city" class="form-control"
value="<?php echo $row['city']; ?>" required>
</div>

<div class="mb-3">
<label>Status</label>

<select name="status" class="form-select">

<option value="Approved"
<?php if($row['status']=="Approved") echo "selected"; ?>>
Approved
</option>

<option value="Pending"
<?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

</select>

</div>

<button type="submit" name="update" class="btn btn-success">
<i class="fa-solid fa-floppy-disk"></i>
Update Hospital
</button>

<a href="hospital.php" class="btn btn-secondary">
Cancel
</a>

</form>

</div>

</div>

</div>

</div>

</body>

</html>