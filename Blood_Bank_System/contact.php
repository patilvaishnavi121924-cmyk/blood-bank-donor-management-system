<?php
include("includes/session.php");
include("database/connection.php");
include("includes/header.php");
include("includes/navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Contact Us | BloodLife</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>
<div class="container py-5">

<div class="text-center mb-5">

<h1 class="text-danger fw-bold">

Contact Us

</h1>

<p>

Have questions? We'd love to hear from you.

</p>

</div>

<div class="row">

<div class="col-md-6">

<form>

<div class="mb-3">

<label>Name</label>

<input
type="text"
class="form-control"
placeholder="Enter your name">

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
class="form-control"
placeholder="Enter your email">

</div>

<div class="mb-3">

<label>Subject</label>

<input
type="text"
class="form-control"
placeholder="Subject">

</div>

<div class="mb-3">

<label>Message</label>

<textarea
class="form-control"
rows="5"
placeholder="Write your message"></textarea>

</div>

<button
class="btn btn-danger">

Send Message

</button>

</form>

</div>

<div class="col-md-6">

<h4 class="text-danger">Contact Information</h4>

<hr>

<p>

<i class="fa-solid fa-location-dot text-danger"></i>

Kalyan, Maharashtra, India

</p>

<p>

<i class="fa-solid fa-phone text-danger"></i>

+91 88006 88006

</p>

<p>

<i class="fa-solid fa-envelope text-danger"></i>

support@LifeDrop.com

</p>

<p>

<i class="fa-solid fa-clock text-danger"></i>

Monday - Saturday

9:00 AM - 9:00 PM

</p>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>

</body>

</html>