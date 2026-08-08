<?php

include("database/connection.php");

$message = "";

if(isset($_POST['register']))
{
    $full_name = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = $_POST['dob'];
    $blood_group = $_POST['blood_group'];
    $mobile = mysqli_real_escape_string($conn, trim($_POST['mobile']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));
    $city = mysqli_real_escape_string($conn, trim($_POST['city']));
    $weight = $_POST['weight'];
    $last_donation = $_POST['last_donation'];
    $password = $_POST['password'];

    // Empty Field Validation

    if(
        empty($full_name) ||
        empty($gender) ||
        empty($dob) ||
        empty($blood_group) ||
        empty($mobile) ||
        empty($email) ||
        empty($address) ||
        empty($city) ||
        empty($weight) ||
        empty($password)
    )
    {
        $message = "All fields are required.";
    }

    elseif(strlen($mobile)!=10 || !ctype_digit($mobile))
    {
        $message = "Enter a valid 10-digit mobile number.";
    }

    elseif(strlen($password)<4)
    {
        $message = "Password must contain at least 4 characters.";
    }

    elseif($weight<50)
    {
        $message = "Weight must be at least 50 kg.";
    }

    else
    {

        // Check Email

        $checkEmail = mysqli_query($conn,"SELECT * FROM donors WHERE email='$email'");

        if(mysqli_num_rows($checkEmail)>0)
        {
            $message = "Email already exists.";
        }

        else
        {

            // Check Mobile

            $checkMobile = mysqli_query($conn,"SELECT * FROM donors WHERE mobile='$mobile'");

            if(mysqli_num_rows($checkMobile)>0)
            {
                $message = "Mobile number already exists.";
            }

            else
            {

                $password = password_hash($password,PASSWORD_DEFAULT);

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
                    '$password',
                    'Active'
                )");

                if($insert)
                {
                    $message = "success";
                }

                else
                {
                    $message = "Registration Failed.";
                }

            }

        }

    }

}

?>

<?php
include("./includes/session.php");
include("includes/header.php");
?>

<section class="register-page">

<div class="container">

<div class="row justify-content-center align-items-center">

<!-- Left Side -->



<!-- Right Side -->

<div class="col-lg-7">

<div class="register-box">

<h2 class="text-center mb-4">

Donor Registration

</h2>

<?php

if($message!="")
{

if($message=="success")
{

?>

<script>

Swal.fire({

icon:'success',

title:'Registration Successful',

text:'Your donor account has been created successfully.',

confirmButtonColor:'#A61E2D'

}).then(()=>{

window.location='login.php';

});

</script>

<?php

}

else

{

?>

<script>

Swal.fire({

icon:'error',

title:'Oops!',

text:'<?php echo $message; ?>',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

}

}

?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Full Name</label>

<input type="text"
name="full_name"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Gender</label>

<select
name="gender"
class="form-select"
required>

<option value="">Select</option>

<option>Male</option>

<option>Female</option>

<option>Other</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Date of Birth</label>

<input
type="date"
name="dob"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Blood Group</label>

<select
name="blood_group"
class="form-select"
required>

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
rows="2"
required></textarea>

</div>

<div class="col-md-6 mb-3">

<label>City</label>

<input
type="text"
name="city"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Weight (kg)</label>

<input
type="number"
name="weight"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Last Donation</label>

<input
type="date"
name="last_donation"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Password</label>

<div class="input-group">

<input
type="password"
name="password"
id="password"
class="form-control"
required>

<button
type="button"
class="btn btn-outline-secondary"
onclick="togglePassword()">

<i class="fa-solid fa-eye"></i>

</button>

</div>

</div>

<div class="col-12 mt-3">

<button
type="submit"
name="register"
class="btn btn-main w-100">

Register Now

</button>

</div>

<div class="text-center mt-3">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</div>

</form>

</div>

</div>

</div>

</div>

</section>

<?php
include("includes/footer.php");
?>