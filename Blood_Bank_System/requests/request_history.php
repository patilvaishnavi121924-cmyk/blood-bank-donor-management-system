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

<title>Request History</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../admin/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>
<div class= "container">

<div class="container-fluid mt-4">

<div class="card shadow">

<div class="card-header bg-danger text-white">

<h4>

<i class="fa-solid fa-clock-rotate-left"></i>

Request History

</h4>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-danger">

<tr>

<th>ID</th>

<th>Patient Name</th>

<th>Blood Group</th>

<th>Units</th>

<th>Reason</th>

<th>Status</th>

<th>Date</th>

</tr>

</thead>
<tbody>
    </div>

<?php

$query=mysqli_query($conn,"
SELECT *
FROM blood_requests
WHERE user_type='NGO'
AND user_id='$ngo_id'
ORDER BY request_id DESC");

if(mysqli_num_rows($query)>0)
{

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['request_id']; ?></td>

<td><?php echo $row['patient_name']; ?></td>

<td><?php echo $row['blood_group']; ?></td>

<td><?php echo $row['units']; ?></td>

<td><?php echo $row['reason']; ?></td>

<td>

<?php

if($row['status']=="Pending")
{

echo "<span class='badge bg-warning text-dark'>Pending</span>";

}

elseif($row['status']=="Approved")
{

echo "<span class='badge bg-success'>Approved</span>";

}

else
{

echo "<span class='badge bg-danger'>Rejected</span>";

}

?>

</td>

<td><?php echo $row['request_date']; ?></td>

</tr>

<?php

}

}
else
{

?>

<tr>

<td colspan="7" class="text-center">

No Blood Requests Found

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

</body>

</html>