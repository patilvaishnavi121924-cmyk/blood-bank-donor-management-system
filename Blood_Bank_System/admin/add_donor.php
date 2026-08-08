<?php

include("../session.php");
include("../database/connection.php");

if(!isset($_SESSION['user_id']))
{
    header("Location:../donor_register.php");
    exit();
}

?>
<?php

if(isset($_POST['save']))
{
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $gender = mysqli_real_escape_string($conn,$_POST['gender']);
    $dob = $_POST['dob'];
    $blood_group = mysqli_real_escape_string($conn,$_POST['blood_group']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $weight = $_POST['weight'];
    $last_donation = $_POST['last_donation'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    // Password must be exactly 4 characters
    if(strlen($password) != 4)
    {
        echo "<script>
        Swal.fire({
            icon:'error',
            title:'Invalid Password',
            text:'Password must be exactly 4 characters.'
        });
        </script>";
    }
    else
    {
        // Check duplicate email
        $emailCheck = mysqli_query($conn,"SELECT donor_id FROM donors WHERE email='$email'");

        if(mysqli_num_rows($emailCheck) > 0)
        {
            echo "<script>
            Swal.fire({
                icon:'error',
                title:'Email Already Exists'
            });
            </script>";
        }
        else
        {
            // Check duplicate mobile
            $mobileCheck = mysqli_query($conn,"SELECT donor_id FROM donors WHERE mobile='$mobile'");

            if(mysqli_num_rows($mobileCheck) > 0)
            {
                echo "<script>
                Swal.fire({
                    icon:'error',
                    title:'Mobile Number Already Exists'
                });
                </script>";
            }
            else
            {
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $insert = mysqli_query($conn,"INSERT INTO donors
                (
                    full_name,
                    gender,
                    dob,
                    blood_group,
                    mobile,
                    email,
                    address,
                    city,
                    weight,
                    last_donation,
                    password,
                    status
                )
                VALUES
                (
                    '$full_name',
                    '$gender',
                    '$dob',
                    '$blood_group',
                    '$mobile',
                    '$email',
                    '$address',
                    '$city',
                    '$weight',
                    '$last_donation',
                    '$hashedPassword',
                    '$status'
                )");

                if($insert)
                {
                    echo "<script>
                    Swal.fire({
                        icon:'success',
                        title:'Success',
                        text:'Donor Added Successfully'
                    }).then(function(){
                        window.location='donor.php';
                    });
                    </script>";
                }
                else
                {
                    echo "<script>
                    Swal.fire({
                        icon:'error',
                        title:'Database Error',
                        text:'Unable to save donor.'
                    });
                    </script>";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>

<title>Add Donor</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

body{
    background:#F5F7FA;
}

.card{
    border:none;
    border-radius:12px;
}

.card-header{
    background:#A61E2D;
    color:white;
}

.btn-save{
    background:#D62828;
    color:white;
}

.btn-save:hover{
    background:#A61E2D;
    color:white;
}

</style>

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header">

<h3><i class="fa fa-user-plus"></i> Add Donor</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label>Full Name</label>
<input type="text" name="full_name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Gender</label>
<select name="gender" class="form-select" required>
<option value="">Select Gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Date of Birth</label>
<input type="date" name="dob" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Blood Group</label>
<select name="blood_group" class="form-select" required>

<option value="">Select</option>

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

<div class="col-md-6 mb-3">

<label>Mobile</label>

<input
type="text"
name="mobile"
maxlength="10"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-12 mb-3">

<label>Address</label>

<textarea
name="address"
class="form-control"
rows="3"></textarea>

</div>

<div class="col-md-6 mb-3">

<label>City</label>

<input
type="text"
name="city"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Weight</label>

<input
type="number"
step="0.01"
name="weight"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Last Donation</label>

<input
type="date"
name="last_donation"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Password (4 Characters)</label>

<input
type="password"
name="password"
maxlength="4"
minlength="4"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="Active">Active</option>

<option value="Inactive">Inactive</option>

</select>

</div>

</div>

<button
type="submit"
name="save"
class="btn btn-save">

<i class="fa fa-save"></i>

Save Donor

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