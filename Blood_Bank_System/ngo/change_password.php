<?php

include("../includes/session.php");
include("../database/connection.php");

if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}

if(!isset($_SESSION['user_id']))
{
    header("Location:../login.php");
    exit();
}

$ngo_id=$_SESSION['user_id'];

if(isset($_POST['change']))
{

$current=$_POST['current_password'];
$new=$_POST['new_password'];
$confirm=$_POST['confirm_password'];

$query=mysqli_query($conn,"SELECT password FROM ngos WHERE ngo_id='$ngo_id'");
$row=mysqli_fetch_assoc($query);

if(!password_verify($current,$row['password']))
{

header("Location:change_password.php?msg=wrong");
exit();

}

if(strlen($new)<4)
{

header("Location:change_password.php?msg=short");
exit();

}

if($new!=$confirm)
{

header("Location:change_password.php?msg=match");
exit();

}

$password=password_hash($new,PASSWORD_DEFAULT);

$update=mysqli_query($conn,"
UPDATE ngos
SET password='$password'
WHERE ngo_id='$ngo_id'
");

if($update)
{

header("Location:change_password.php?msg=success");

}
else
{

header("Location:change_password.php?msg=error");

}

exit();

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../admin/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

if(isset($_GET['msg']))
{

if($_GET['msg']=="success")
{

?>

<script>

Swal.fire({

icon:'success',

title:'Success',

text:'Password Changed Successfully.',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

}

elseif($_GET['msg']=="wrong")
{

?>

<script>

Swal.fire({

icon:'error',

title:'Wrong Password',

text:'Current Password is incorrect.',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

}

elseif($_GET['msg']=="short")
{

?>

<script>

Swal.fire({

icon:'warning',

title:'Password',

text:'Password must be at least 4 characters.',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

}

elseif($_GET['msg']=="match")
{

?>

<script>

Swal.fire({

icon:'warning',

title:'Password',

text:'New Password and Confirm Password do not match.',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

}

elseif($_GET['msg']=="error")
{

?>

<script>

Swal.fire({

icon:'error',

title:'Error',

text:'Unable to change password.',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

}

}

?>

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main-content">

<?php include("topbar.php"); ?>

<div class="container-fluid mt-4">

<div class="card shadow">

<div class="card-header bg-danger text-white">

<h4>

<i class="fa-solid fa-key"></i>

Change Password

</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Current Password</label>

<input
type="password"
name="current_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>New Password</label>

<input
type="password"
name="new_password"
class="form-control"
maxlength="4"
required>

</div>

<div class="mb-3">

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
maxlength="4"
required>

</div>

<div class="text-center">

<button
type="submit"
name="change"
class="btn btn-danger px-5">

<i class="fa-solid fa-key"></i>

Change Password

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</body>

</html>