<?php

include("database/connection.php");

if(isset($_POST['register']))
{
    $hospital_name = mysqli_real_escape_string($conn,$_POST['hospital_name']);
    $contact_person = mysqli_real_escape_string($conn,$_POST['contact_person']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(strlen($password)!=4)
    {
        echo "<script>alert('Password must be exactly 4 characters.');</script>";
    }
    elseif($password!=$confirm_password)
    {
        echo "<script>alert('Passwords do not match.');</script>";
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
                'Pending'
            )");

            if($insert)
            {
                echo "<script>
                alert('Registration Successful. Wait for Admin Approval.');
                window.location='login.php';
                </script>";
            }
            else
            {
                echo "<script>alert('Registration Failed.');</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hospital Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

body{
    background:#F5F7FA;
    font-family:Poppins,sans-serif;
}

.register-card{
    max-width:800px;
    margin:50px auto;
    background:#FFFFFF;
    border-radius:15px;
    box-shadow:0 8px 25px rgba(0,0,0,.15);
    overflow:hidden;
}

.card-header{
    background:#A61E2D;
    color:#fff;
    text-align:center;
    padding:20px;
}

.card-header h2{
    margin:0;
    font-weight:bold;
}

.card-body{
    padding:30px;
}

.form-control{
    border-radius:8px;
}

.btn-register{
    background:#D62828;
    color:#fff;
    font-weight:bold;
}

.btn-register:hover{
    background:#A61E2D;
    color:#fff;
}

.login-link{
    text-align:center;
    margin-top:20px;
}

.login-link a{
    color:#274C77;
    text-decoration:none;
    font-weight:bold;
}

.login-link a:hover{
    text-decoration:underline;
}

</style>

</head>

<body>

<div class="container">

<div class="register-card">

<div class="card-header">

<h2><i class="fa-solid fa-hospital"></i> Hospital Registration</h2>

<p class="mb-0">Register your hospital to request blood</p>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Hospital Name</label>

<input type="text"
name="hospital_name"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Contact Person</label>

<input type="text"
name="contact_person"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Mobile Number</label>

<input type="text"
name="mobile"
maxlength="10"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email Address</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-12 mb-3">

<label>Address</label>

<textarea
name="address"
class="form-control"
rows="3"
required></textarea>

</div>

<div class="col-md-6 mb-3">

<label>City</label>

<input type="text"
name="city"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Password (4 Characters)</label>

<input type="password"
name="password"
maxlength="4"
minlength="4"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Confirm Password</label>

<input type="password"
name="confirm_password"
maxlength="4"
minlength="4"
class="form-control"
required>

</div>

</div>

<div class="text-center">

<button
type="submit"
name="register"
class="btn btn-register px-5">

<i class="fa-solid fa-user-plus"></i>

Register

</button>

</div>

<div class="login-link">

Already Registered?

<a href="login.php">

Login Here

</a>

</div>

</form>

</div>

</div>

</div>

</body>

</html>