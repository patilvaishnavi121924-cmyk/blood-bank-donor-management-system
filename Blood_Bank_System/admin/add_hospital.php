<?php

include("../session.php");
include("../database/connection.php");

if(!isset($_SESSION['user_id']))
{
    header("Location:../hospital_register.php");
    exit();
}

if(isset($_POST['save']))
{
    $hospital_name = mysqli_real_escape_string($conn,$_POST['hospital_name']);
    $contact_person = mysqli_real_escape_string($conn,$_POST['contact_person']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $password = $_POST['password'];
    $status = $_POST['status'];

    if(strlen($password)!=4)
    {
        echo "<script>alert('Password must be exactly 4 characters.');</script>";
    }
    else
    {
        $check=mysqli_query($conn,"SELECT * FROM hospitals
        WHERE email='$email' OR mobile='$mobile'");

        if(mysqli_num_rows($check)>0)
        {
            echo "<script>alert('Email or Mobile already exists.');</script>";
        }
        else
        {
            $password=password_hash($password,PASSWORD_DEFAULT);

            $insert=mysqli_query($conn,"INSERT INTO hospitals
            (
                hospital_name,
                contact_person,
                mobile,
                email,
                address,
                city,
                password,
                status
            )
            VALUES
            (
                '$hospital_name',
                '$contact_person',
                '$mobile',
                '$email',
                '$address',
                '$city',
                '$password',
                '$status'
            )");

            if($insert)
            {
                echo "<script>
                alert('Hospital Added Successfully');
                window.location='hospital.php';
                </script>";
            }
            else
            {
                echo "<script>alert('Database Error');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Hospital</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-danger text-white">

<h3>Add Hospital</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label>Hospital Name</label>
<input type="text" name="hospital_name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Contact Person</label>
<input type="text" name="contact_person" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Mobile</label>
<input type="text" name="mobile" maxlength="10" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="col-md-12 mb-3">
<label>Address</label>
<textarea name="address" class="form-control" rows="3"></textarea>
</div>

<div class="col-md-6 mb-3">
<label>City</label>
<input type="text" name="city" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Password (4 Characters)</label>
<input type="password" name="password" maxlength="4" minlength="4" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Status</label>
<select name="status" class="form-select">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
</select>
</div>

</div>

<button type="submit" name="save" class="btn btn-danger">
Save Hospital
</button>

<a href="hospital.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

</div>

</div>

</body>
</html>