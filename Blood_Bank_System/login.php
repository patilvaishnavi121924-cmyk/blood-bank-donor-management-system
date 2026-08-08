<?php

include("includes/session.php");
include("database/connection.php");

$message = "";

if(isset($_POST['login']))
{

    $user_type = $_POST['user_type'];
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];

    if(empty($user_type) || empty($email) || empty($password))
    {
        $message = "Please fill all fields.";
    }

    else
    {

        switch($user_type)
        {

            case "Admin":
                $table="admins";
                $id="admin_id";
                $dashboard="admin/dashboard.php";
            break;

            case "Donor":
                $table="donors";
                $id="donor_id";
                $dashboard="admin/donor.php";
            break;

            case "Hospital":
                $table="hospitals";
                $id="hospital_id";
                $dashboard="admin/hospital.php";
            break;

            case "NGO":
                $table="ngos";
                $id="ngo_id";
                $dashboard="ngo/ngo.php";
            break;

            default:

                $message="Invalid User Type.";

        }

        if($message=="")
        {

            $query=mysqli_query($conn,"SELECT * FROM $table WHERE email='$email'");

            if(mysqli_num_rows($query)==1)
            {

                $row=mysqli_fetch_assoc($query);

                if(password_verify($password,$row['password']))
                {

                    $_SESSION['user_id']=$row[$id];

                    $_SESSION['user_name']=$row['full_name'] ?? $row['hospital_name'] ?? $row['ngo_name'];

                    $_SESSION['user_type']=$user_type;

                    header("Location:$dashboard");

                    exit();

                }

                else
                {

                    $message="Incorrect Password.";

                }

            }

            else
            {

                $message="Email Not Registered.";

            }

        }

    }

}

?>

<?php
include("includes/header.php");
include("includes/navbar.php");
?>

<section class="login-page">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-5">

<div class="login-box">

<h2 class="text-center mb-4">

Login

</h2>

<form method="POST">
    <?php

if($message!="")
{

?>

<script>

Swal.fire({

icon:'error',

title:'Login Failed',

text:'<?php echo $message; ?>',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

}

?>

<div class="mb-3">

<label>User Type</label>

<select name="user_type" class="form-select" required>

<option value="">Select User</option>

<option>Admin</option>

<option>Donor</option>

<option>Hospital</option>

<option>NGO</option>

</select>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<div class="input-group">

<input
type="password"
name="password"
id="loginPassword"
class="form-control"
required>

<button
type="button"
class="btn btn-outline-secondary"
onclick="showLoginPassword()">

<i class="fa-solid fa-eye"></i>

</button>

</div>

</div>

<button
type="submit"
name="login"
class="btn btn-main w-100">

Login

</button>

<div class="text-center mt-3">

Don't have an account?

<a href="register.php">

Register

</a>

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