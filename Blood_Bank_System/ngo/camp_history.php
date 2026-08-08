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

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Camp History</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../admin/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

if(isset($_GET['msg']))
{

    if($_GET['msg']=="deleted")
    {

?>

<script>

Swal.fire({

icon:'success',

title:'Deleted',

text:'Camp deleted successfully.',

confirmButtonColor:'#A61E2D'

});

</script>

<?php

    }

    elseif($_GET['msg']=="updated")
    {

?>

<script>

Swal.fire({

icon:'success',

title:'Updated',

text:'Camp updated successfully.',

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

Camp History

</h4>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-danger">

<tr>

<th>ID</th>

<th>Camp Name</th>

<th>Location</th>

<th>Date</th>

<th>Expected Donors</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query($conn,"
SELECT *
FROM blood_camps
WHERE ngo_id='$ngo_id'
ORDER BY camp_date DESC");

if(mysqli_num_rows($query)>0)
{

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['camp_id']; ?></td>

<td><?php echo $row['camp_name']; ?></td>

<td><?php echo $row['location']; ?></td>

<td><?php echo $row['camp_date']; ?></td>

<td><?php echo $row['expected_donors']; ?></td>

<td>

<?php

if($row['status']=="Upcoming")
{

echo "<span class='badge bg-warning text-dark'>Upcoming</span>";

}
elseif($row['status']=="Completed")
{

echo "<span class='badge bg-success'>Completed</span>";

}
else
{

echo "<span class='badge bg-danger'>Cancelled</span>";

}

?>

</td>

<td>

<a
href="edit_camp.php?id=<?php echo $row['camp_id']; ?>"
class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a
href="#"
onclick="confirmDelete(<?php echo $row['camp_id']; ?>)"
class="btn btn-danger btn-sm">

<i class="fa fa-trash"></i>

</a>

</td>

</tr>

<?php

}

}
else
{

?>

<tr>

<td colspan="7" class="text-center">

No Camps Found

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<script>

function confirmDelete(id)
{

Swal.fire({

title:'Delete Camp?',

text:'This action cannot be undone.',

icon:'warning',

showCancelButton:true,

confirmButtonColor:'#D62828',

cancelButtonColor:'#274C77',

confirmButtonText:'Delete'

}).then((result)=>{

if(result.isConfirmed)
{

window.location='delete_camp.php?id='+id;

}

});

}

</script>

</body>

</html>