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

$ngo_id = $_SESSION['user_id'];

if(isset($_POST['submit']))
{

    $patient_name = mysqli_real_escape_string($conn,$_POST['patient_name']);
    $blood_group = mysqli_real_escape_string($conn,$_POST['blood_group']);
    $units = mysqli_real_escape_string($conn,$_POST['units']);
    $reason = mysqli_real_escape_string($conn,$_POST['reason']);

    $insert = mysqli_query($conn,"
    INSERT INTO blood_requests
    (
        user_type,
        user_id,
        patient_name,
        blood_group,
        units,
        reason,
        status
    )

    VALUES
    (
        'NGO',
        '$ngo_id',
        '$patient_name',
        '$blood_group',
        '$units',
        '$reason',
        'Pending'
    )");

    if($insert)
    {
        header("Location:request_blood.php?msg=success");
        exit();
    }
    else
    {
        header("Location:request_blood.php?msg=error");
        exit();
    }

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Request Blood</title>

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

text:'Blood Request Submitted Successfully.',

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

text:'Unable to Submit Request.',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

    }

}

?>

</head>

<body>





<div class="container">
    <div class="container-fluid mt-5">

<div class="card shadow">

<div class="card-header bg-danger text-white">

<h4>

<i class="fa-solid fa-droplet"></i>

Request Blood

</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Patient Name</label>

<input
type="text"
name="patient_name"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Blood Group</label>

<select
name="blood_group"
class="form-select"
required>

<option value="">Select Blood Group</option>

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

<label>Units Required</label>

<input
type="number"
name="units"
min="1"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Reason</label>

<input
type="text"
name="reason"
class="form-control"
required>

</div>

<div class="col-12 text-center">

<button
type="submit"
name="submit"
class="btn btn-danger px-5">

<i class="fa-solid fa-paper-plane"></i>

Submit Request

</button>

<a href="dashboard.php"
class="btn btn-secondary px-5">

Back

</a>

</div>

</div>

</form>
</div>

</div>

</div>

</div>

</div>

</body>

</html>