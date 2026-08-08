<?php

include("../includes/session.php");
include("../database/connection.php");

if(!isset($_SESSION['user_id']))
{
    header("Location:../login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
<title>Manage Hospitals</title>

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
    text:'Hospital deleted successfully.',
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
    text:'Hospital updated successfully.',
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
    text:'Unable to delete hospital.',
    confirmButtonColor:'#A61E2D'
});

</script>

<?php

    }

}

?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

<?php include("./sidebar.php"); ?>

<div class="main-content">

<?php include("./topbar.php"); ?>

<div class="container-fluid mt-4">

<div class="d-flex justify-content-between mb-4">

<h2>Manage Hospitals</h2>

<a href="add_hospital.php" class="btn btn-danger">

<i class="fa fa-plus"></i>

Add Hospital

</a>

</div>

<form method="GET">

<div class="row mb-3">

<div class="col-md-4">

<input
type="text"
name="search"
class="form-control"
placeholder="Search Hospital">

</div>

<div class="col-md-2">

<button class="btn btn-primary">

Search

</button>

</div>

</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-danger">

<tr>

<th>ID</th>

<th>Hospital</th>

<th>Contact Person</th>

<th>Mobile</th>

<th>Email</th>

<th>City</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php
$search="";

if(isset($_GET['search']))
{
    $search=mysqli_real_escape_string($conn,$_GET['search']);
}

$query=mysqli_query($conn,"
SELECT *
FROM hospitals
WHERE hospital_name LIKE '%$search%'
OR contact_person LIKE '%$search%'
OR city LIKE '%$search%'
OR mobile LIKE '%$search%'
ORDER BY hospital_id DESC
");

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['hospital_id']; ?></td>

<td><?php echo $row['hospital_name']; ?></td>

<td><?php echo $row['contact_person']; ?></td>

<td><?php echo $row['mobile']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['city']; ?></td>

<td>

<?php

if($row['status']=="Approved")
{
    echo "<span class='badge bg-success'>Approved</span>";
}
else
{
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}

?>

</td>

<td>

<a href="view_hospital.php?id=<?php echo $row['hospital_id']; ?>" class="btn btn-info btn-sm">

<i class="fa fa-eye"></i>

</a>

<a href="edit_hospital.php?id=<?php echo $row['hospital_id']; ?>" class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a href="#" onclick="confirmDelete(<?php echo $row['hospital_id']; ?>)" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i>
</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>
<script>

function confirmDelete(id)
{
    Swal.fire({

        title:'Delete Hospital?',

        text:'This action cannot be undone.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#D62828',

        cancelButtonColor:'#274C77',

        confirmButtonText:'Delete',

        cancelButtonText:'Cancel'

    }).then((result)=>{

        if(result.isConfirmed)
        {
            window.location='delete_hospital.php?id='+id;
        }

    });

}


</script>
</body>

</html>