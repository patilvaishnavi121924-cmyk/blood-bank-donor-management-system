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

if(isset($_POST['save']))
{

    $camp_name = mysqli_real_escape_string($conn,$_POST['camp_name']);
    $location = mysqli_real_escape_string($conn,$_POST['location']);
    $camp_date = $_POST['camp_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $expected_donors = $_POST['expected_donors'];
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $insert = mysqli_query($conn,"
    INSERT INTO blood_camps
    (
        ngo_id,
        camp_name,
        location,
        camp_date,
        start_time,
        end_time,
        expected_donors,
        description,
        status
    )

    VALUES
    (
        '$ngo_id',
        '$camp_name',
        '$location',
        '$camp_date',
        '$start_time',
        '$end_time',
        '$expected_donors',
        '$description',
        'Upcoming'
    )");

    if($insert)
    {
        header("Location:organize_camp.php?msg=success");
        exit();
    }
    else
    {
        header("Location:organize_camp.php?msg=error");
        exit();
    }

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Organize Blood Camp</title>

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

text:'Blood Camp Created Successfully.',

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

text:'Unable to Create Camp.',

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

<i class="fa-solid fa-tents"></i>

Organize Blood Camp

</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Camp Name</label>

<input
type="text"
name="camp_name"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Location</label>

<input
type="text"
name="location"
class="form-control"
required>

</div>

<div class="col-md-4 mb-3">

<label>Camp Date</label>

<input
type="date"
name="camp_date"
class="form-control"
required>

</div>

<div class="col-md-4 mb-3">

<label>Start Time</label>

<input
type="time"
name="start_time"
class="form-control"
required>

</div>

<div class="col-md-4 mb-3">

<label>End Time</label>

<input
type="time"
name="end_time"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Expected Donors</label>

<input
type="number"
name="expected_donors"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="3"
required></textarea>

</div>

<div class="col-12 text-center">

<button
type="submit"
name="save"
class="btn btn-danger px-5">

<i class="fa-solid fa-floppy-disk"></i>

Save Camp

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

</body>

</html>