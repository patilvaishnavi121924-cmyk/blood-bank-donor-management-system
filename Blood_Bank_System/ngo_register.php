<?php

include("database/connection.php");

$message = "";

if(isset($_POST['register']))
{
    $ngo_name = mysqli_real_escape_string($conn,$_POST['ngo_name']);
    $contact_person = mysqli_real_escape_string($conn,$_POST['contact_person']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(strlen($password) < 4)
    {
        $message = "Password must be at least 4 characters.";
    }
    elseif($password != $confirm_password)
    {
        $message = "Passwords do not match.";
    }
    else
    {
        $check = mysqli_query($conn,
        "SELECT * FROM ngos WHERE email='$email'");

        if(mysqli_num_rows($check) > 0)
        {
            $message = "Email already registered.";
        }
        else
        {
            $password = password_hash($password,PASSWORD_DEFAULT);

            $insert = mysqli_query($conn,"
            INSERT INTO ngos
            (
                ngo_name,
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
                '$ngo_name',
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
                alert('Registration Successful! Waiting for Admin Approval.');
                window.location='login.php';
                </script>";
                exit();
            }
            else
            {
                $message = "Registration Failed.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>NGO Registration</title>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body>
<section class="register-page">

<div class="container">

<div class="row justify-content-center align-items-center">

<!-- Left Side -->



<!-- Right Side -->

<div class="col-lg-7">

<div class="register-box">

<h2 class="text-center mb-4">

NGO Registration

</h2>


<?php
if($message!="")
{
?>
<div class="alert alert-danger">
<?php echo $message; ?>
</div>
<?php
}
?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>NGO Name</label>

<input
type="text"
name="ngo_name"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Contact Person</label>

<input
type="text"
name="contact_person"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Mobile</label>

<input
type="text"
name="mobile"
class="form-control"
maxlength="10"
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

<div class="col-12 mb-3">

<label>Address</label>

<textarea
name="address"
class="form-control"
rows="3"
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

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
maxlength="4"
required>

</div>

<div class="col-md-6 mb-3">

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
maxlength="4"
required>

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


</body>

</html>

</section>

<?php
include("includes/footer.php");
?>